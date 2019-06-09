<?php

namespace app\modules\hosting\controllers\admin;

use app\modules\hosting\forms\domain\DnsNsEditForm;
use Yii;
use yii\base\Exception;
use app\modules\hosting\components\Api;
use app\modules\hosting\forms\domain\DomainCheckForm;
use yii\helpers\VarDumper;

class DomainController extends CommonController
{

    function sorting($a, $b)
    {
        return strnatcmp($a['classname'], $b['classname']);
    }

    public function actionIndex()
    {
        $api = new Api('dns_domain', 'info');
        if ($api->response['status'] == 'success') {
            return $this->render('index', ['response' => $api->response['data']]);
        } else {
            throw new Exception($api->response['message']);
        }
    }

    public function actionCheck()
    {
        //  $api = new Api('dns_domain', 'check',['stack'=>['corner-cms.com']]);
        $domainList = [];
        $api = new Api('dns_domain', 'zones', ['available' => 1]);
        //  echo $apiZones->response->data;

        foreach ($api->response['data'] as $data) {

            $domainList[$data['class']['name']][] = array(
                'domain_name' => $data['name'],
                'domain_price' => $data['price'],
                'classname' => $data['class']['name'],
            );
        }

        $selectOptions = [];
        foreach ($domainList as $key => $items) {
            //usort($items, 'sorting');
            $i = 0;
            foreach ($items as $row) {
                $i++;
                $selectOptions[$key][$row['domain_name']] = $row['domain_name'];
            }
        }

        $checkData = array();
        $stackDomain = array();
        $model = new DomainCheckForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $domainArray = explode(',', $model->name);
            if (count($domainArray) <= 10) {
                foreach ($domainArray as $stack) {
                    foreach ($model->domain as $domain) {
                        $stackDomain[] = $stack . "." . $domain;
                    }
                }
                $api = new Api('dns_domain', 'check', ['stack' => $stackDomain]); //array('stack' => array($model->name . "." . $model->domain))


                foreach ($api->response['data'] as $domain => $data) {
                    $checkData[$domain][] = $data;
                }
            }
        }


        return $this->render('check', [
            'model' => $model,
            'api' => $api,
            'checkData' => $checkData,
            'selectOptions' => $selectOptions,
        ]);
    }


    public function actionZones()
    {
        $apiZones = new Api('dns_domain', 'zones', ['available' => 1]);
        $checkData = [];
        $stackDomain = [];
        $model = new DomainCheckForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $domainArray = explode(',', $model->name);
            if (count($domainArray) <= 10) {
                foreach ($domainArray as $stack) {
                    foreach ($model->domain as $domain) {
                        $stackDomain[] = $stack . "." . $domain;
                    }
                }
                $api = new Api('dns_domain', 'check', ['stack' => $stackDomain]); //array('stack' => array($model->name . "." . $model->domain))

                foreach ($api->response['data'] as $domain => $data) {
                    $checkData[$domain][] = $data;
                }
            }
        }

        return $this->render('zones', [
            'response' => $apiZones->response['data'],
            'model' => $model,
            'checkData' => $checkData,
        ]);
    }

    public function actionDnsRecord()
    {
        $this->buttons[] = [
            'label' => Yii::t('hosting/default', 'BTN_DOMAIN_DNS_RECORD_RESTORE'),
            'url' => ['restore']
        ];

        $api = new Api('dns_record', 'info', ['domain' => 'shopium24.com']);

        if ($api->response['status'] == 'success') {
            return $this->render('dns_record', ['response' => $api->response]);
        } else {
            throw new Exception($api->response['message']);
        }
    }

    /**
     * Метод восстановление DNS записей по-умолчанию.
     *
     * @param string $domain Domain name
     * @return string
     * @throws Exception
     */
    public function actionDnsRestore($domain)
    {
        $api = new Api('dns_record', 'restore', ['domain' => $domain]);

        if ($api->response['status'] == 'success') {
            return $this->render('dns_restore', ['response' => $api->response]);
        } else {
            throw new Exception($api->response['message']);
        }
    }

    /**
     * Метод редактирование DNS записей домена.
     *
     * @param string $domain Domain name
     * @return string
     * @throws Exception
     */
    public function actionDnsEdit($domain)
    {

        return $this->render('dns_edit', ['response' => $api->response]);
        /*$api = new Api('dns_record', 'restore', ['domain' => $domain]);

        if ($api->response['status'] == 'success') {
            return $this->render('dns_restore', ['response' => $api->response]);
        } else {
            throw new Exception($api->response['message']);
        }*/
    }


    public function actionDnsNs($domain)
    {

        $api_dns_ns_edit = new Api('dns_ns', 'edit', ['domain' => $domain]);
        /*$this->pageName = Yii::t('hosting/default', 'DOMAIN_DNS_NS_EDIT2', ['domain' => $domain]);
        if ($api->response['status'] == 'success') {
            return $this->render('dns_ns_edit', ['response' => $api->response]);
        } else {
            throw new Exception($api->response['message']);
        }*/


        $model = new DnsNsEditForm();


        $api = new Api('dns_ns', 'info', ['domain' => $domain]);
        $this->pageName = Yii::t('hosting/default', 'DOMAIN_DNS_NS2', ['domain' => $domain]);
        if ($api->response['status'] == 'success') {
            return $this->render('dns_ns', [
                'response' => $api->response,
                'dns_ns_edit' => $api_dns_ns_edit,
                'model' => $model
            ]);
        } else {
            throw new Exception($api->response['message']);
        }
    }

}
