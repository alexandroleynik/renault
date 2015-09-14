<?php

use yii\db\Schema;
use yii\db\Migration;

class m150910_094151_body_field_limit extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%timeline_event}}', 'data', Schema::TYPE_TEXT . ' (16000000)');
        $this->alterColumn('{{%page}}', 'body', Schema::TYPE_TEXT . ' (16000000)');
        $this->alterColumn('{{%article}}', 'body', Schema::TYPE_TEXT . ' (16000000)');
        $this->alterColumn('{{%block}}', 'body', Schema::TYPE_TEXT . ' (16000000)');
        $this->alterColumn('{{%client}}', 'body', Schema::TYPE_TEXT . ' (16000000)');
        $this->alterColumn('{{%info}}', 'body', Schema::TYPE_TEXT . ' (16000000)');
        $this->alterColumn('{{%member}}', 'body', Schema::TYPE_TEXT . ' (16000000)');
        $this->alterColumn('{{%model}}', 'body', Schema::TYPE_TEXT . ' (16000000)');
        $this->alterColumn('{{%project}}', 'body', Schema::TYPE_TEXT . ' (16000000)');
        $this->alterColumn('{{%promo}}', 'body', Schema::TYPE_TEXT . ' (16000000)');
        $this->alterColumn('{{%widget_text}}', 'body', Schema::TYPE_TEXT . ' (16000000)');

    }

    public function down()
    {
        echo "m150910_094151_body_field_limit cannot be reverted.\n";

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
