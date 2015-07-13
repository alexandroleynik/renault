<?php

use yii\db\Schema;
use yii\db\Migration;

class m150713_191217_article_description extends Migration
{
    public function up()
    {
        $this->addColumn('{{%article}}', 'description', Schema::TYPE_STRING . '(512) NOT NULL');
    }

    public function down()
    {
        echo "m150713_191217_article_description cannot be reverted.\n";

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
