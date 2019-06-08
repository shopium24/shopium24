<?php

namespace app\modules\hosting\controllers\admin;

use Yii;
use yii\base\Exception;
use app\modules\hosting\components\Api;


class BillingController extends CommonController {


    public function actionIndex() {
        $api = new Api('billing_invoice', 'info');
        if ($api->response['status'] == 'success') {
            return $this->render('index', ['response' => $api->response['data']]);
        } else {
            throw new Exception($api->response['message']);
        }
    }

    
    public function actionPay() {
        $api = new Api('billing_invoice', 'pay',['invoice'=>Yii::$app->request->get('invoice')]);
        if ($api->response['status'] == 'success') {
            return $this->render('pay', ['response' => $api->response['data']]);
        } else {
            throw new Exception($api->response['message']);
        }
    }
    
    
    public function actionProlong () {
        $api = new Api('billing_cart', 'prolong',[]);
        if ($api->response['status'] == 'success') {
            return $this->render('pay', ['response' => $api->response['data']]);
        } else {
            throw new Exception($api->response['message']);
        }
    }

    /**
     * Метод prolong - пролонгация услуг. Выписывает счет на оплату.
     */
    public function actionProlongDomain(){
        $api = new Api('billing_cart', 'prolong',[]);
    }
    public function actionProlongHosting(){
        $api = new Api('billing_cart', 'prolong',[]);
    }


}
