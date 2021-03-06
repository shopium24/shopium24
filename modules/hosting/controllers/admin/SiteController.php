<?php

namespace app\modules\hosting\controllers\admin;


use Yii;
use yii\base\Exception;
use app\modules\hosting\components\Api;
use app\modules\hosting\forms\site\HostCreateForm;
use app\modules\hosting\forms\site\HostSiteConfigWSForm;

class SiteController extends CommonController
{

    public function actionIndex()
    {
        $this->buttons[] = [
            'label' => Yii::t('hosting/default', 'HOSTING_SITE_HOST_CREATE'),
            'url' => ['host-create'],
            'options' => ['class' => 'btn btn-success']
        ];
        $api = new Api('hosting_site', 'info');
        if ($api->response['status'] == 'success') {
            return $this->render('index', ['response' => $api->response['data']]);
        } else {
            throw new Exception($api->response['message']);
        }
    }

    public function actionView()
    {
        $this->buttons[] = [
            'label' => Yii::t('hosting/default', 'HOSTING_SITE_HOST_CREATE'),
            'url' => ['host-create'],
            'options' => ['class' => 'btn btn-success']
        ];
        $api = new Api('hosting_site', 'info', ['site' => 'pixelion.com.ua']);
        if ($api->response['status'] == 'success') {
            print_r($api->response['data']);
            die;
            return $this->render('index', ['response' => $api->response['data']]);
        } else {
            throw new Exception($api->response['message']);
        }
    }


    public function actionHostCreate()
    {
        $model = new HostCreateForm();
        $response = false;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $params['site'] = $model->site;
            $params['subdomain'] = $model->subdomain;

            $api = new Api('hosting_site', 'host_create', $params);

            if ($api->response['status'] == 'success') {
                $response = $api->response['data'];
                Yii::$app->session->setFlash('success', Yii::t('hosting/default', 'SUCCESS_HOST_CREATE', [
                    'site' => $model->site,
                    'subdomain' => $model->subdomain,
                ]));
            }
        }
        return $this->render('host_create', [
            'model' => $model,
            'response' => $response,
        ]);
    }

    public function actionHostEdit($host)
    {

        $model = new HostSiteConfigWSForm();
        $response = false;
        $params['host'] = $host;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $params['site'] = $model->site;


                $api = new Api('hosting_site_config_ws', 'edit', $params);

            if ($api->response['status'] == 'success') {
                $response = $api->response['data'];
                Yii::$app->session->setFlash('success', Yii::t('hosting/default', 'SUCCESS_HOST_CREATE', [
                    'site' => $model->site,
                    'subdomain' => $model->subdomain,
                ]));
            }
        }
        return $this->render('host_edit', [
            'model' => $model,
            'response' => $response,
        ]);
    }

    public function actionDelete($host)
    {
        if ($host != 'www') {
            $params['host'] = $host;
            $params['file'] = 1;
            $params['mailbox'] = 1;

            $api = new Api('hosting_site', 'host_delete', $params);

            if ($api->response['status'] == 'success') {
                Yii::$app->session->setFlash('success', Yii::t('hosting/default', 'SUCCESS_SUBDOMAIN_DELETE', [
                    'host' => $host,
                ]));
            } else {
                Yii::$app->session->setFlash('error', $api->response['message']);
            }
            $this->redirect(['index']);
        }
    }
}
