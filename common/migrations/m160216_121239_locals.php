<?php

use yii\db\Schema;
use yii\db\Migration;
class m160216_121239_locals extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }



        $this->addColumn('{{%domain}}', 'av_locale', Schema::TYPE_INTEGER . '(128)');
    }

    public function down()
    {
        echo "m160216_121239_locals cannot be reverted.\n";

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
