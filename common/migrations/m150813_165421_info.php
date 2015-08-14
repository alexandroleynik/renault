<?php

use yii\db\Schema;
use yii\db\Migration;

class m150813_165421_info extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%info_category}}', [
            'id'         => Schema::TYPE_PK,
            'slug'       => Schema::TYPE_STRING . '(1024)',
            'title'      => Schema::TYPE_STRING . '(512)',
            'body'       => Schema::TYPE_TEXT,
            'parent_id'  => Schema::TYPE_INTEGER,
            'status'     => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'weight'     => Schema::TYPE_SMALLINT
            ], $tableOptions);

        $this->createTable('{{%info}}', [
            //main
            'id'                 => Schema::TYPE_PK,
            'slug'               => Schema::TYPE_STRING . '(1024)',
            'title'              => Schema::TYPE_STRING . '(512)',
            //custom
            'description'        => Schema::TYPE_STRING . '(512)',
            'head'               => Schema::TYPE_TEXT,
            'body'               => Schema::TYPE_TEXT,
            //common
            'category_id'        => Schema::TYPE_INTEGER,
            'model_id'           => Schema::TYPE_INTEGER,
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
            'domain'             => Schema::TYPE_STRING,
            ], $tableOptions);

        $this->insert('{{%info_category}}', [
            'id'         => 1,
            'slug'       => 'news',
            'title'      => 'News',
            'status'     => 1,
            'created_at' => time()
        ]);

        $this->createIndex('idx_info_author_id', '{{%info}}', 'author_id');
        $this->addForeignKey('fk_info_author', '{{%info}}', 'author_id', '{{%user}}', 'id', 'cascade', 'cascade');

        $this->createIndex('idx_info_updater_id', '{{%info}}', 'updater_id');
        $this->addForeignKey('fk_info_updater', '{{%info}}', 'updater_id', '{{%user}}', 'id', 'set null', 'cascade');

        $this->createIndex('idx_category_id', '{{%info}}', 'category_id');
        $this->addForeignKey('fk_info_category', '{{%info}}', 'category_id', '{{%info_category}}', 'id');

        $this->createIndex('idx_model_id', '{{%info}}', 'model_id');
        $this->addForeignKey('fk_info_model', '{{%info}}', 'model_id', '{{%model}}', 'id');

        $this->createIndex('idx_parent_id', '{{%info_category}}', 'parent_id');
        $this->addForeignKey('fk_info_category_section', '{{%info_category}}', 'parent_id', '{{%info_category}}', 'id', 'cascade', 'cascade');

        $this->createTable('{{%info_attachment}}', [
            'id'         => Schema::TYPE_PK,
            'info_id'    => Schema::TYPE_INTEGER . ' NOT NULL',
            'path'       => Schema::TYPE_STRING . ' NOT NULL',
            'base_url'   => Schema::TYPE_STRING,
            'type'       => Schema::TYPE_STRING,
            'size'       => Schema::TYPE_INTEGER,
            'name'       => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER
        ]);
        $this->addForeignKey(
            'fk_info_attachment_info', '{{%info_attachment}}', 'info_id', '{{%info}}', 'id', 'cascade', 'cascade'
        );

        $this->createTable('{{%info_categories}}', [
            'id'          => Schema::TYPE_PK,
            'info_id'     => Schema::TYPE_INTEGER,
            'category_id' => Schema::TYPE_INTEGER,
            ], $tableOptions);
    }

    public function down()
    {
        echo "m150813_165421_info cannot be reverted.\n";

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