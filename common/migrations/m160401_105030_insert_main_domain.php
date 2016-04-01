<?php

use yii\db\Migration;

class m160401_105030_insert_main_domain extends Migration
{
    public function up()
    {
        $this->execute("INSERT INTO `domain` (`id`, `title`, `description`, `created_at`, `updated_at`, `status`, `locale`, `locale_group_id`, `dealer_id`, `av_locale`, `logo_base_url`, `logo_path`, `m_logo_base_url`, `m_logo_path`) VALUES
(0, 'm.renault.ua', '', NULL, 1459506476, 1, 'uk', NULL, NULL, 0, NULL, NULL, NULL, NULL);");
    }

    public function down()
    {
        echo "m160401_105030_insert_main_domain cannot be reverted.\n";

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
