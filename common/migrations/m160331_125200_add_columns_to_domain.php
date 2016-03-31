<?php

use yii\db\Migration;

class m160331_125200_add_columns_to_domain extends Migration
{
    public function up()
    {
        $this->execute("ALTER TABLE  `domain`
                        ADD  `logo_base_url` VARCHAR( 1024 ) NULL ,
                        ADD  `logo_path` VARCHAR( 1024 ) NULL ,
                        ADD  `m_logo_base_url` VARCHAR( 1024 ) NULL ,
                        ADD  `m_logo_path` VARCHAR( 1024 ) NULL ;");
    }

    public function down()
    {
        echo "m160331_125200_add_columns_to_domain cannot be reverted.\n";

        return false;
    }
}
