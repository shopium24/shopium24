<?php

namespace app\modules\hosting\models;

use panix\engine\db\ActiveRecord;
use Yii;

class Account extends ActiveRecord
{


    const MODULE_ID = 'hosting';
    const route = '/admin/hosting/default';


    public static function find() {
        return new AccountQuery(get_called_class());
    }



    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return '{{%hosting_account}}';
    }

}
