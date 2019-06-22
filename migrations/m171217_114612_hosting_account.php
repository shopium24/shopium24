<?php

/**
 * Generation migrate by PIXELION CMS
 *
 * @author PIXELION CMS development team <dev@pixelion.com.ua>
 * @link http://pixelion.com.ua PIXELION CMS
 *
 * Class m171217_114612_hosting_account
 */
use panix\engine\db\Migration;
use app\modules\hosting\models\Account;

class m171217_114612_hosting_account extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable(Account::tableName(), [
            'id' => $this->primaryKey()->unsigned(),
            'login' => $this->string(50)->notNull(),
            'token' => $this->string(255)->notNull(),
            'account' => $this->string(10)->notNull(),
        ], $this->tableOptions);
        //$this->createIndex('switch', $this->tableName, 'switch');
        //$this->createIndex('ordern', $this->tableName, 'ordern');


    }

    public function down()
    {
        $this->dropTable(Account::tableName());
    }

}
