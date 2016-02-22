<?php

use yii\db\Migration;
use yii\db\Schema;

class m160221_132832_price extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%price}}', [
            'id'         => Schema::TYPE_PK,
            'model' => Schema::TYPE_STRING . '(512)',
            'version'      => Schema::TYPE_STRING . '(512)',
            'version_code'       => Schema::TYPE_STRING . '(512)',
            'body_type'       => Schema::TYPE_STRING . '(512)',
            'price'       => Schema::TYPE_STRING . '(512)',
            'status'     => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'weight'     => Schema::TYPE_SMALLINT,
            'locale'             => Schema::TYPE_STRING,
            'locale_group_id'    => Schema::TYPE_INTEGER,
            'domain_id'  => Schema::TYPE_INTEGER,
        ], $tableOptions);


    }

    public function down()
    {
        echo "m160221_132832_price cannot be reverted.\n";

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
