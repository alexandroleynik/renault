<?php
use yii\db\Schema;
use yii\db\Migration;

class m160119_152505_add_column_feedback extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }



        $this->addColumn('{{%feedback_form}}', 'subject', Schema::TYPE_STRING . '(128)');
    }

    public function down()
    {
        echo "m160119_152505_add_column_feedback cannot be reverted.\n";

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
