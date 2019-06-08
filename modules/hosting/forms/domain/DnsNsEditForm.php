<?php

namespace app\modules\hosting\forms\domain;

use Yii;
use panix\engine\base\Model;

class DnsNsEditForm extends Model
{

    protected $module = 'hosting';

    public $domain;
    public $stack;

    public $ns1;
    public $ns2;
    public $ns3;
    public $ns4;

    public function rules()
    {
        return [
            [['domain', 'stack'], 'required'],

            [['ns1', 'ns2', 'ns3', 'ns4'], 'trim'],
            [['ns1', 'ns2', 'ns3', 'ns4'], 'unique', 'targetAttribute' => ['ns1', 'ns2', 'ns3', 'ns4']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'ns1' => 'NS #1',
            'ns2' => 'NS #2',
            'ns3' => 'NS #3',
            'ns4' => 'NS #4',
        ];
    }



}
