<?php

use yii\db\Schema;
use yii\db\Migration;

class m150711_155813_insert_key_storage_item extends Migration
{

    public function up()
    {

        $this->insert('{{%key_storage_item}}', [
            'key'   => 'frontend_app_conainer',
            'value' => '#ajaxContent'
        ]);

        /*$this->insert('{{%key_storage_item}}', [
            'key'   => 'frontend_app_default_route',
            'value' => '/ru/page/view/home'
        ]);*/
        /*         * ** */
        $this->insert('{{%key_storage_item}}', [
            'key'   => 'frontend_app_log_clear_page',
            'value' => '1'
        ]);
    }

    public function down()
    {
        echo "m150711_155813_insert_key_storage_item cannot be reverted.\n";

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