<?php

use yii\db\Schema;
use yii\db\Migration;

class m150911_051808_before_body_after_body extends Migration
{

    public function up()
    {
        $this->addColumn('{{%page}}', 'before_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%article}}', 'before_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%block}}', 'before_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%client}}', 'before_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%info}}', 'before_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%member}}', 'before_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%model}}', 'before_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%project}}', 'before_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%promo}}', 'before_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%widget_text}}', 'before_body', Schema::TYPE_TEXT . ' (16000000)');

        $this->addColumn('{{%page}}', 'after_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%article}}', 'after_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%block}}', 'after_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%client}}', 'after_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%info}}', 'after_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%member}}', 'after_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%model}}', 'after_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%project}}', 'after_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%promo}}', 'after_body', Schema::TYPE_TEXT . ' (16000000)');
        $this->addColumn('{{%widget_text}}', 'after_body', Schema::TYPE_TEXT . ' (16000000)');
    }

    public function down()
    {
        echo "m150911_051808_before_body_after_body cannot be reverted.\n";

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