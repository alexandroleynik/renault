<?php

use yii\db\Schema;
use yii\db\Migration;

class m151230_134255_timestamp_for_form extends Migration
{
    public function up()
    {
         $this->addColumn('{{%subscribe_form}}', 'created_at', Schema::TYPE_INTEGER);         
         $this->addColumn('{{%subscribe_form}}', 'updated_at', Schema::TYPE_INTEGER);

         $this->addColumn('{{%corporate_sales}}', 'created_at', Schema::TYPE_INTEGER);
         $this->addColumn('{{%corporate_sales}}', 'updated_at', Schema::TYPE_INTEGER);

    }

    public function down()
    {
        echo "m151230_134255_timestamp_for_form cannot be reverted.\n";

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
