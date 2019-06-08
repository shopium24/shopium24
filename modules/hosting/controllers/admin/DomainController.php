<?php

namespace app\modules\hosting\controllers\admin;

use Yii;
use yii\base\Exception;
use app\modules\hosting\components\Api;
use app\modules\hosting\forms\domain\DomainCheckForm;

class DomainController extends CommonController {

    function sorting($a, $b) {
        return strnatcmp($a['classname'], $b['classname']);
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionCheck() {
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
                    'api'=>$api,
                    'checkData' => $checkData,
                    'selectOptions' => $selectOptions,
        ]);
    }

    public function actionInfo() {
        $api = new Api('dns_domain', 'info');
        if ($api->response['status'] == 'success') {
            return $this->render('info', ['response' => $api->response['data']]);
        } else {
            throw new Exception($api->response['message']);
        }
    }

    public function actionZones() {
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


}
