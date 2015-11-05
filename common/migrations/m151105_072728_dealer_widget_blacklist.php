<?php

use yii\db\Schema;
use yii\db\Migration;

class m151105_072728_dealer_widget_blacklist extends Migration
{
    public function up()
    {
        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.widgets.dealer.blacklist',
            'value' => 'find-a-dealer,corporate-sales,contact,financing,subscribes'
        ]);
    }

    public function down()
    {
        echo "m151105_072728_dealer_widget_blacklist cannot be reverted.\n";

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
