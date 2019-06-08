<?php

namespace app\modules\hosting\forms\domain;

use Yii;
use panix\engine\base\Model;

class DnsEditForm extends Model
{

    protected $module = 'hosting';

    public $domain;
    public $stack;

    public function rules()
    {
        return [
            [['domain', 'stack'], "required"],
        ];
    }


}
