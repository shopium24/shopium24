<?php

namespace app\modules\hosting\components;

use Yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\base\InvalidParamException;
use yii\helpers\VarDumper;
use yii\httpclient\Client;

class Api
{

    public $response;

    public function __construct($class, $method, $config = array(), $response_format = false)
    {
        $language = Yii::$app->language;
        $api_config = Yii::$app->settings->get('hosting');

        if (isset($config['account'])) {
            //if ($config['account']) {
            if (!is_string($config['account'])) {
                $config['account'] = false;
            }
            // }
        } else {
            if (isset($api_config->account)) {
                $config['account'] = $api_config->account;
            }
        }
       /* $curl = Yii::$app->curl;
        $response = $curl->setRawPostData(Json::encode(ArrayHelper::merge([
            'auth_login' => $api_config->auth_login,
            'auth_token' => $api_config->auth_token,
            'class' => $class,
            'method' => $method,
        ], $config)))
            ->setHeaders(['Content-Type' => "application/json; charset=" . Yii::$app->charset])
            ->post('https://adm.tools/api.php');*/





        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->addHeaders(['content-type' => "application/json; charset=" . Yii::$app->charset])
            ->setUrl('https://adm.tools/api.php')
            ->setData(ArrayHelper::merge([
                'auth_login' => $api_config->auth_login,
                'auth_token' => $api_config->auth_token,
                'class' => $class,
                'method' => $method,
            ], $config))
            ->send();



        if ($response->isOk) {
            $this->response = $response->data;
           // print_r($this->response);die;
            if ($this->response['status'] == 'success') {
                Yii::$app->log->traceLevel = 0;
                Yii::info("Success {$class}::{$method}",'Hosting/Api');
            }
        }
       // VarDumper::dump($this->response,10,true);die;


    }

    public static function reasonCode($data)
    {
        if ($data['reason_code'] == 'already_served') {
            return 'Доменное имя уже обслуживается';
        } elseif ($data['reason_code'] == 'object_exists') {
            return 'object_exists';
        } else {
            return '---';
        }
    }
}
