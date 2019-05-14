<?php

namespace app\modules\hosting\components;

use Yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\base\InvalidParamException;

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
        $curl = Yii::$app->curl;
        $response = $curl->setRawPostData(Json::encode(ArrayHelper::merge([
            'auth_login' => $api_config->auth_login,
            'auth_token' => $api_config->auth_token,
            'class' => $class,
            'method' => $method,
        ], $config)))
            ->setHeaders(['Content-Type' => "application/json; charset=" . Yii::$app->charset])
            ->post('https://adm.tools/api.php');



        if ($curl->errorCode === null) {

            $this->response = Json::decode($response, false);

        } else {
            // List of curl error codes here https://curl.haxx.se/libcurl/c/libcurl-errors.html
            switch ($curl->errorCode) {

                case 6:
                    //host unknown example
                    break;
            }
            $this->response = $response;
        }

    }

    public static function reasonCode($data)
    {
        if ($data->reason_code == 'already_served') {
            return 'Доменное имя уже обслуживается';
        } elseif ($data->reason_code == 'object_exists') {
            return 'object_exists';
        } else {
            return '---';
        }
    }
}
