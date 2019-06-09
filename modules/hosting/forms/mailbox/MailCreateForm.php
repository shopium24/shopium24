<?php

namespace app\modules\hosting\forms\mailbox;

use app\modules\hosting\components\Api;
use panix\engine\base\Model;

class MailCreateForm extends Model
{

    protected $module = 'hosting';

    public $domain;
    public $mailbox;
    public $password;
    public $type = 'mailbox';
    public $forward;
    public $antispam = 'medium';
    public $autoresponder;
    public $autoresponder_title;
    public $autoresponder_text;

    public function rules()
    {
        return [
            [['mailbox', 'password'], "required"],
            [['domain'], "required",'on'=>'create'],
            //['type', 'in', 'range' => $this->getTypeArray()],
            //['antispam', 'in', 'range' => $this->getAntispamArray()],
            [['autoresponder_text', 'autoresponder_title', 'forward', 'type', 'antispam'], 'string'],
            [['password'], 'string', 'min' => 8],
            //['mailbox', 'email'],
            ['autoresponder', 'boolean']
        ];
    }


    public function getTypeList()
    {
        return [
            'mailbox' => 'mailbox - стандартный почтовый ящик',
            'redirect' => 'redirect - вся почта будет перенаправляться с новосозданного ящика на почтовые ящики',
            'copy' => 'copy - стандартный почтовый ящик с функцией перенаправления почты',
        ];
    }

    public function getAntiSpamList()
    {
        return [
            'off' => 'off - антиспам отключен',
            'low' => 'low - низкий уровень защиты от спама',
            'medium' => 'medium - средний уровень защиты',
            'high ' => 'high - высокий уровень защиты',
        ];
    }

    public function getDomains()
    {
        $api = new Api('hosting_site', 'info');
        $sites = [];
        if ($api->response['status'] == 'success') {
            foreach ($api->response['data'] as $key => $data) {
                $sites['@'.$data['name']] = '@'.$data['name'];
            }
        }
        return $sites;
    }

}
