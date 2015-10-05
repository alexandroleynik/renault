<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_162712_about extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%about_category}}', [
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

        $this->createTable('{{%about}}', [
            //main
            'id'          => Schema::TYPE_PK,
            'slug'        => Schema::TYPE_STRING . '(1024)',
            'title'       => Schema::TYPE_STRING . '(512)',
            //custom
            'price'       => Schema::TYPE_STRING . '(512)',
            'description' => Schema::TYPE_STRING . '(512)',
            'head'        => Schema::TYPE_TEXT,
            'body'        => Schema::TYPE_TEXT . ' (16000000)',
            'before_body' => Schema::TYPE_TEXT . ' (16000000)',
            'after_body'  => Schema::TYPE_TEXT . ' (16000000)',
            'on_scenario' => Schema::TYPE_STRING . '(512)',
            //common
            'category_id'        => Schema::TYPE_INTEGER,
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

        $this->insert('{{%about_category}}', [
            'id'         => 1,
            'slug'       => 'news',
            'title'      => 'News',
            'status'     => 1,
            'created_at' => time()
        ]);

        $this->createIndex('idx_about_author_id', '{{%about}}', 'author_id');
        $this->addForeignKey('fk_about_author', '{{%about}}', 'author_id', '{{%user}}', 'id', 'cascade', 'cascade');

        $this->createIndex('idx_about_updater_id', '{{%about}}', 'updater_id');
        $this->addForeignKey('fk_about_updater', '{{%about}}', 'updater_id', '{{%user}}', 'id', 'set null', 'cascade');

        $this->createIndex('idx_category_id', '{{%about}}', 'category_id');
        $this->addForeignKey('fk_about_category', '{{%about}}', 'category_id', '{{%about_category}}', 'id');

        $this->createIndex('idx_parent_id', '{{%about_category}}', 'parent_id');
        $this->addForeignKey('fk_about_category_section', '{{%about_category}}', 'parent_id', '{{%about_category}}', 'id', 'cascade', 'cascade');

        $this->createTable('{{%about_attachment}}', [
            'id'         => Schema::TYPE_PK,
            'about_id'   => Schema::TYPE_INTEGER . ' NOT NULL',
            'path'       => Schema::TYPE_STRING . ' NOT NULL',
            'base_url'   => Schema::TYPE_STRING,
            'type'       => Schema::TYPE_STRING,
            'size'       => Schema::TYPE_INTEGER,
            'name'       => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER
        ]);
        $this->addForeignKey(
            'fk_about_attachment_about', '{{%about_attachment}}', 'about_id', '{{%about}}', 'id', 'cascade', 'cascade'
        );

        $this->createTable('{{%about_categories}}', [
            'id'          => Schema::TYPE_PK,
            'about_id'    => Schema::TYPE_INTEGER,
            'category_id' => Schema::TYPE_INTEGER,
            ], $tableOptions);
    }

    public function down()
    {
        echo "m150930_133211_about cannot be reverted.\n";

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