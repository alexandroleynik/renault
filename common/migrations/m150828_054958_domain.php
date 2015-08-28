<?php

use yii\db\Schema;
use yii\db\Migration;

class m150828_054958_domain extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%domain}}', [
            //main
            'id'              => Schema::TYPE_PK,
            'title'           => Schema::TYPE_STRING,
            'description'     => Schema::TYPE_STRING,
            'created_at'      => Schema::TYPE_INTEGER,
            'updated_at'      => Schema::TYPE_INTEGER,
            'status'          => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'locale'          => Schema::TYPE_STRING,
            'locale_group_id' => Schema::TYPE_INTEGER,
            ], $tableOptions);
    }

    public function down()
    {
        echo "m150828_054958_domain cannot be reverted.\n";

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