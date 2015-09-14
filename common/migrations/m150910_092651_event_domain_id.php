<?php

use yii\db\Schema;
use yii\db\Migration;

class m150910_092651_event_domain_id extends Migration
{
    public function up()
    {
        $this->addColumn('{{%timeline_event}}', 'domain_id', Schema::TYPE_INTEGER);
    }

    public function down()
    {
        echo "m150910_092651_event_domain_id cannot be reverted.\n";

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
