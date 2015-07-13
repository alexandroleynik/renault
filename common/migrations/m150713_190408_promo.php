<?php

use yii\db\Schema;
use yii\db\Migration;

class m150713_190408_promo extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%promo_category}}', [
            'id'         => Schema::TYPE_PK,
            'slug'       => Schema::TYPE_STRING . '(1024) NOT NULL',
            'title'      => Schema::TYPE_STRING . '(512) NOT NULL',
            'body'       => Schema::TYPE_TEXT,
            'parent_id'  => Schema::TYPE_INTEGER,
            'status'     => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            ], $tableOptions);

        $this->createTable('{{%promo}}', [
            'id'           => Schema::TYPE_PK,
            'slug'         => Schema::TYPE_STRING . '(1024) NOT NULL',
            'title'        => Schema::TYPE_STRING . '(512) NOT NULL',
            'description'  => Schema::TYPE_STRING . '(512) NOT NULL',
            'body'         => Schema::TYPE_TEXT . ' NOT NULL',
            'category_id'  => Schema::TYPE_INTEGER,
            'author_id'    => Schema::TYPE_INTEGER,
            'updater_id'   => Schema::TYPE_INTEGER,
            'status'       => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'published_at' => Schema::TYPE_INTEGER,
            'created_at'   => Schema::TYPE_INTEGER,
            'updated_at'   => Schema::TYPE_INTEGER,
            ], $tableOptions);

        $this->insert('{{%promo_category}}', [
            'id'         => 1,
            'slug'       => 'news',
            'title'      => 'News',
            'status'     => 1,
            'created_at' => time()
        ]);

        $this->createIndex('idx_promo_author_id', '{{%promo}}', 'author_id');
        $this->addForeignKey('fk_promo_author', '{{%promo}}', 'author_id', '{{%user}}', 'id', 'cascade', 'cascade');

        $this->createIndex('idx_promo_updater_id', '{{%promo}}', 'updater_id');
        $this->addForeignKey('fk_promo_updater', '{{%promo}}', 'updater_id', '{{%user}}', 'id', 'set null', 'cascade');

        $this->createIndex('idx_category_id', '{{%promo}}', 'category_id');
        $this->addForeignKey('fk_promo_category', '{{%promo}}', 'category_id', '{{%promo_category}}', 'id');

        $this->createIndex('idx_parent_id', '{{%promo_category}}', 'parent_id');
        $this->addForeignKey('fk_promo_category_section', '{{%promo_category}}', 'parent_id', '{{%promo_category}}', 'id', 'cascade', 'cascade');

        $this->createTable('{{%promo_attachment}}', [
            'id'         => Schema::TYPE_PK,
            'promo_id'   => Schema::TYPE_INTEGER . ' NOT NULL',
            'path'       => Schema::TYPE_STRING . ' NOT NULL',
            'base_url'   => Schema::TYPE_STRING,
            'type'       => Schema::TYPE_STRING,
            'size'       => Schema::TYPE_INTEGER,
            'name'       => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER
        ]);
        $this->addForeignKey(
            'fk_promo_attachment_promo', '{{%promo_attachment}}', 'promo_id', '{{%promo}}', 'id', 'cascade', 'cascade'
        );

        $this->addColumn('{{%promo}}', 'thumbnail_base_url', Schema::TYPE_STRING . '(1024)');
        $this->addColumn('{{%promo}}', 'thumbnail_path', Schema::TYPE_STRING . '(1024)');

        $this->addColumn('{{%promo}}', 'weight', Schema::TYPE_SMALLINT . ' NULL');
        $this->addColumn('{{%promo_category}}', 'weight', Schema::TYPE_SMALLINT . ' NULL');

        $this->addColumn('{{%promo}}', 'head', Schema::TYPE_TEXT . ' NOT NULL');

        $this->addColumn('{{%promo}}', 'locale', Schema::TYPE_STRING . '(512) NOT NULL DEFAULT "ru-RU"');

        $this->addColumn('{{%promo}}', 'locale_group_id', Schema::TYPE_INTEGER);

        $this->createTable('{{%promo_categories}}', [
            'id'          => Schema::TYPE_PK,
            'promo_id'    => Schema::TYPE_INTEGER,
            'category_id' => Schema::TYPE_INTEGER,
            ], $tableOptions);

        $this->addColumn('{{%promo}}', 'domain', Schema::TYPE_STRING);
    }

    public function down()
    {
        echo "m150713_190408_promo cannot be reverted.\n";

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