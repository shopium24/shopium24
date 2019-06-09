<?php

namespace app\modules\hosting\forms\ftp;

use Yii;
use app\modules\hosting\components\Api;
use panix\engine\base\Model;

class AccountForm extends Model
{

    protected $module = 'hosting';
    public $account;

    public function rules()
    {
        return [
            [['account'], "required"],
        ];
    }

    public function getAccounts()
    {
        $api = new Api('hosting_account', 'info', ['account' => false]);
        $result = [];
        if ($api->response['status'] == 'success') {
            foreach ($api->response['data'] as $data) {
                $result[$data['login']] = $data['login'];
            }
        }
        return $result;
    }


}
