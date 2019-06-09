<?php

namespace app\modules\hosting\forms\database;

use app\modules\hosting\components\Api;
use panix\engine\base\Model;

class UserPasswordForm extends Model
{

    protected $module = 'hosting';
    public $api;

    public $user;
    public $password;

    public function rules()
    {
        return [
            [['user', 'password'], 'required'],
            ['user', 'userValidate'],
            ['password', 'string', 'length' => [2, 30]],
            //['user', 'string', 'max' => 11],
        ];
    }

    public function userValidate($attribute)
    {
        $api = new Api('hosting_database', 'user_password', [
            'user' => $this->user,
            'password' => $this->password,
        ]);

        if ($api->response['status'] == 'error') {
            $this->addError($attribute, $api->response['message']);
        }
    }

    public function afterValidate2()
    {
        parent::afterValidate();
        $this->api = new Api('hosting_database', 'user_password', [
            'user' => $this->user,
            'password' => $this->password,
        ]);
        if ($this->api->response['status'] == 'success') {
            return true;
        } else {
            return false;
        }
    }
}
