<?php

use yii\db\Schema;
use yii\db\Migration;

class m151214_190947_subscribe_form extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%subscribe_form}}', [
            'id'              => Schema::TYPE_PK,
            'firstname'            => Schema::TYPE_STRING . '(1024)',
            'secondname'           => Schema::TYPE_STRING . '(1024)',
            'lastname'     => Schema::TYPE_STRING . '(1024)',
            'email'           => Schema::TYPE_STRING . '(1024)',
            'phone'     => Schema::TYPE_STRING . '(14)',
            'status'          => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'domain_id'       => Schema::TYPE_INTEGER
        ], $tableOptions);
    }

    public function down()
    {
        echo "m151214_190947_subscribe_form cannot be reverted.\n";

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
