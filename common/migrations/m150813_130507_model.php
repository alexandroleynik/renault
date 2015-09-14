<?php

use yii\db\Schema;
use yii\db\Migration;

class m150813_130507_model extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%model_category}}', [
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

        $this->createTable('{{%model}}', [
            //main
            'id'                 => Schema::TYPE_PK,
            'slug'               => Schema::TYPE_STRING . '(1024)',
            'title'              => Schema::TYPE_STRING . '(512)',
            //custom            
            'price'              => Schema::TYPE_STRING . '(512)',
            'description'        => Schema::TYPE_STRING . '(512)',
            'head'               => Schema::TYPE_TEXT,
            'body'               => Schema::TYPE_TEXT,
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
            'domain'             => Schema::TYPE_STRING,
            ], $tableOptions);

        $this->insert('{{%model_category}}', [
            'id'         => 1,
            'slug'       => 'news',
            'title'      => 'News',
            'status'     => 1,
            'created_at' => time()
        ]);

        $this->createIndex('idx_model_author_id', '{{%model}}', 'author_id');
        $this->addForeignKey('fk_model_author', '{{%model}}', 'author_id', '{{%user}}', 'id', 'cascade', 'cascade');

        $this->createIndex('idx_model_updater_id', '{{%model}}', 'updater_id');
        $this->addForeignKey('fk_model_updater', '{{%model}}', 'updater_id', '{{%user}}', 'id', 'set null', 'cascade');

        $this->createIndex('idx_category_id', '{{%model}}', 'category_id');
        $this->addForeignKey('fk_model_category', '{{%model}}', 'category_id', '{{%model_category}}', 'id');

        $this->createIndex('idx_parent_id', '{{%model_category}}', 'parent_id');
        $this->addForeignKey('fk_model_category_section', '{{%model_category}}', 'parent_id', '{{%model_category}}', 'id', 'cascade', 'cascade');

        $this->createTable('{{%model_attachment}}', [
            'id'         => Schema::TYPE_PK,
            'model_id'   => Schema::TYPE_INTEGER . ' NOT NULL',
            'path'       => Schema::TYPE_STRING . ' NOT NULL',
            'base_url'   => Schema::TYPE_STRING,
            'type'       => Schema::TYPE_STRING,
            'size'       => Schema::TYPE_INTEGER,
            'name'       => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER
        ]);
        $this->addForeignKey(
            'fk_model_attachment_model', '{{%model_attachment}}', 'model_id', '{{%model}}', 'id', 'cascade', 'cascade'
        );

        $this->createTable('{{%model_categories}}', [
            'id'          => Schema::TYPE_PK,
            'model_id'    => Schema::TYPE_INTEGER,
            'category_id' => Schema::TYPE_INTEGER,
            ], $tableOptions);
    }

    public function down()
    {
        echo "m150813_130507_model cannot be reverted.\n";

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