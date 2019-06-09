<?php

namespace app\modules\hosting\forms\database;

use panix\engine\base\Model;

class UserPrivilegesForm extends Model
{

    protected $module = 'hosting';

    public $database;
    public $user;
    public $privileges;

    public function rules()
    {
        return [
            [['database', 'user', 'privileges'], "required"],
        ];
    }

    public function getPrivilegesList()
    {
        return [
            'select' => 'select',
            'insert' => 'insert',
            'update' => 'update',
            'delete' => 'delete',
            'create' => 'create',
            'drop' => 'drop',
            'index' => 'index',
            'alter' => 'alter',
            'lock_tables' => 'lock_tables',
            'create_temporary_tables' => 'create_temporary_tables',
            'create_view' => 'create_view',
            'show_view' => 'show_view',
            'create_routine' => 'create_routine',
            'alter_routine' => 'alter_routine',
            'execute' => 'execute',
            'references' => 'references',
            'trigger' => 'trigger',
            'event' => 'event'
        ];
    }

}
