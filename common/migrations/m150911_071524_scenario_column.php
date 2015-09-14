<?php

use yii\db\Schema;
use yii\db\Migration;

class m150911_071524_scenario_column extends Migration
{

    public function up()
    {
        $this->addColumn('{{%page}}', 'on_scenario', Schema::TYPE_STRING . '(512)');
        $this->addColumn('{{%article}}', 'on_scenario', Schema::TYPE_STRING . '(512)');
        $this->addColumn('{{%block}}', 'on_scenario', Schema::TYPE_STRING . '(512)');
        $this->addColumn('{{%client}}', 'on_scenario', Schema::TYPE_STRING . '(512)');
        $this->addColumn('{{%info}}', 'on_scenario', Schema::TYPE_STRING . '(512)');
        $this->addColumn('{{%member}}', 'on_scenario', Schema::TYPE_STRING . '(512)');
        $this->addColumn('{{%model}}', 'on_scenario', Schema::TYPE_STRING . '(512)');
        $this->addColumn('{{%project}}', 'on_scenario', Schema::TYPE_STRING . '(512)');
        $this->addColumn('{{%promo}}', 'on_scenario', Schema::TYPE_STRING . '(512)');
        $this->addColumn('{{%widget_text}}', 'on_scenario', Schema::TYPE_STRING . '(512)');
    }

    public function down()
    {
        echo "m150911_071524_scenario_column cannot be reverted.\n";

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