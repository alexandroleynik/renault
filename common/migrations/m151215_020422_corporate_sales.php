<?php

use yii\db\Schema;
use yii\db\Migration;

class m151215_020422_corporate_sales extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%corporate_sales}}', [
            'id'              => Schema::TYPE_PK,
            'firstname'            => Schema::TYPE_STRING . '(1024)',
            'secondname'           => Schema::TYPE_STRING . '(1024)',
            'lastname'     => Schema::TYPE_STRING . '(1024)',
            'email'           => Schema::TYPE_STRING . '(1024)',
            'myemail'           => Schema::TYPE_STRING . '(1024)',
            'message'           => Schema::TYPE_STRING . '(2048)',

            'phone'     => Schema::TYPE_STRING . '(14)',
            'status'          => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'domain_id'       => Schema::TYPE_INTEGER
        ], $tableOptions);
    }

    public function down()
    {
        echo "m151215_020422_corporate_sales cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
