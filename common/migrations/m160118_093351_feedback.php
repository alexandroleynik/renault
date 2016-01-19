<?php
use yii\db\Schema;
use yii\db\Migration;

class m160118_093351_feedback extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%feedback_form}}', [
            'id'                =>  Schema::TYPE_PK,
            'text'              =>  Schema::TYPE_TEXT . ' (16000000)',
            'created_at'        =>  Schema::TYPE_INTEGER,
            'updated_at'        =>  Schema::TYPE_INTEGER,
            'status'            =>  Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'domain_id'         =>  Schema::TYPE_INTEGER
        ], $tableOptions);
        $this->createTable('{{%email_for_feedback_form}}', [
            'id'                =>  Schema::TYPE_PK,
            'email'              =>  Schema::TYPE_TEXT . ' (16000000)',
            'created_at'        =>  Schema::TYPE_INTEGER,
            'updated_at'        =>  Schema::TYPE_INTEGER,
            'status'            =>  Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'domain_id'         =>  Schema::TYPE_INTEGER
        ], $tableOptions);
    }

    public function down()
    {
        echo "m160118_093351_feedback cannot be reverted.\n";

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
