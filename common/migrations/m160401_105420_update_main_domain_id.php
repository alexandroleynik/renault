<?php

use yii\db\Migration;

class m160401_105420_update_main_domain_id extends Migration
{
    public function up()
    {
        $this->execute("UPDATE `domain` SET `id`='0' WHERE `title`='m.renault.ua'");
    }

    public function down()
    {
        echo "m160401_105420_update_main_domain_id cannot be reverted.\n";

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
