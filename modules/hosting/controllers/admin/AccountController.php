<?php

namespace app\modules\hosting\controllers\admin;

use Yii;
use yii\base\Exception;
use app\modules\hosting\components\Api;


class AccountController extends CommonController {

    public function actionIndex() {
        if (Yii::$app->request->get('account')) {
            $account = Yii::$app->request->get('account');
        } else {
            $account = false;
        }
        $api = new Api('hosting_account', 'info', ['account' => $account]);
        if ($api->response['status'] == 'success') {
            return $this->render('index', ['response' => $api->response['data']]);
        } else {
            throw new Exception($api->response['message']);
        }
    }


    public function actionPlans() {
        $api = new Api('hosting_account', 'plans');
        if ($api->response['status'] == 'success') {
            return $this->render('plans', ['response' => $api->response['data']]);
        } else {
            throw new Exception($api->response['message']);
        }
    }
    public function actionInfo($account) {
        $api = new Api('hosting_account', 'info',['account'=>$account]);
        if ($api->response['status'] == 'success') {
            return $this->render('info', ['response' => $api->response['data']]);
        } else {
            throw new Exception($api->response['message']);
        }
    }
    public function actionMigrate() {
        $api = new Api('hosting_account', 'migrate');
        if ($api->response['status'] == 'success') {
            return $this->render('migrate', ['response' => $api->response['data']]);
        } else {
            throw new Exception($api->response['message']);
        }
    }

    public function actionMigrateCancel() {
        $api = new Api('hosting_account', 'migration_cancel');
        if ($api->response['status'] == 'success') {
            return $this->render('migrate', ['response' => $api->response['data']]);
        } else {
            throw new Exception($api->response['message']);
        }
    }

    public function getAddonsMenu()
    {
        return [
            [
                'label' => Yii::t('hosting/default', 'PLANS'),
                'url' => ['plans'],
               // 'icon' => Html::icon('user'),
            ],
        ];
    }
}
