<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_134129_service_page extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%service_page_category}}', [
            'id'         => Schema::TYPE_PK,
            'slug'       => Schema::TYPE_STRING . '(1024)',
            'title'      => Schema::TYPE_STRING . '(512)',
            'body'       => Schema::TYPE_TEXT . ' (16000000)',
            'parent_id'  => Schema::TYPE_INTEGER,
            'status'     => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'weight'     => Schema::TYPE_SMALLINT,
            'domain_id'  => Schema::TYPE_INTEGER,
            ], $tableOptions);

        $this->createTable('{{%service_page}}', [
            //main
            'id'                 => Schema::TYPE_PK,
            'slug'               => Schema::TYPE_STRING . '(1024)',
            'title'              => Schema::TYPE_STRING . '(512)',
            //custom
            'description'        => Schema::TYPE_STRING . '(512)',
            'head'               => Schema::TYPE_TEXT,
            'body'               => Schema::TYPE_TEXT . ' (16000000)',
            'before_body'        => Schema::TYPE_TEXT . ' (16000000)',
            'after_body'         => Schema::TYPE_TEXT . ' (16000000)',
            'on_scenario'        => Schema::TYPE_STRING . '(512)',
            //common
            'category_id'        => Schema::TYPE_INTEGER,
            'service_id'         => Schema::TYPE_INTEGER,
            'author_id'          => Schema::TYPE_INTEGER,
            'updater_id'         => Schema::TYPE_INTEGER,
            'status'             => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'published_at'       => Schema::TYPE_INTEGER,
            'created_at'         => Schema::TYPE_INTEGER,
            'updated_at'         => Schema::TYPE_INTEGER,
            'thumbnail_base_url' => Schema::TYPE_STRING . '(1024)',
            'thumbnail_path'     => Schema::TYPE_STRING . '(1024)',
            'weight'             => Schema::TYPE_SMALLINT,
            'locale'             => Schema::TYPE_STRING,
            'locale_group_id'    => Schema::TYPE_INTEGER,
            'domain_id'          => Schema::TYPE_INTEGER,
            ], $tableOptions);

        $this->insert('{{%service_page_category}}', [
            'id'         => 1,
            'slug'       => 'news',
            'title'      => 'News',
            'status'     => 1,
            'created_at' => time()
        ]);

        $this->createIndex('idx_service_page_author_id', '{{%service_page}}', 'author_id');
        $this->addForeignKey('fk_service_page_author', '{{%service_page}}', 'author_id', '{{%user}}', 'id', 'cascade', 'cascade');

        $this->createIndex('idx_service_page_updater_id', '{{%service_page}}', 'updater_id');
        $this->addForeignKey('fk_service_page_updater', '{{%service_page}}', 'updater_id', '{{%user}}', 'id', 'set null', 'cascade');

        $this->createIndex('idx_category_id', '{{%service_page}}', 'category_id');
        $this->addForeignKey('fk_service_page_category', '{{%service_page}}', 'category_id', '{{%service_page_category}}', 'id');

        $this->createIndex('idx_service_id', '{{%service_page}}', 'service_id');
        $this->addForeignKey('fk_service_page_service', '{{%service_page}}', 'service_id', '{{%service}}', 'id');

        $this->createIndex('idx_parent_id', '{{%service_page_category}}', 'parent_id');
        $this->addForeignKey('fk_service_page_category_section', '{{%service_page_category}}', 'parent_id', '{{%service_page_category}}', 'id', 'cascade', 'cascade');

        $this->createTable('{{%service_page_attachment}}', [
            'id'              => Schema::TYPE_PK,
            'service_page_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'path'            => Schema::TYPE_STRING . ' NOT NULL',
            'base_url'        => Schema::TYPE_STRING,
            'type'            => Schema::TYPE_STRING,
            'size'            => Schema::TYPE_INTEGER,
            'name'            => Schema::TYPE_STRING,
            'created_at'      => Schema::TYPE_INTEGER
        ]);
        $this->addForeignKey(
            'fk_service_page_attachment_service_page', '{{%service_page_attachment}}', 'service_page_id', '{{%service_page}}', 'id', 'cascade', 'cascade'
        );

        $this->createTable('{{%service_page_categories}}', [
            'id'              => Schema::TYPE_PK,
            'service_page_id' => Schema::TYPE_INTEGER,
            'category_id'     => Schema::TYPE_INTEGER,
            ], $tableOptions);
    }

    public function down()
    {
        echo "m150813_165421_service_page cannot be reverted.\n";

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