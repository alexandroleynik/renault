<?php

use yii\db\Schema;
use yii\db\Migration;

class m150827_054730_domain_id_column extends Migration
{

    public function up()
    {
        //new
        $this->addColumn('{{%client}}', 'domain_id', Schema::TYPE_INTEGER);
        $this->addColumn('{{%member}}', 'domain_id', Schema::TYPE_INTEGER);
        $this->addColumn('{{%user}}', 'domain_id', Schema::TYPE_INTEGER);
        $this->addColumn('{{%page}}', 'domain_id', Schema::TYPE_INTEGER);
        $this->addColumn('{{%widget_text}}', 'domain_id', Schema::TYPE_INTEGER);

        $this->addColumn('{{%client_category}}', 'domain_id', Schema::TYPE_INTEGER);
        $this->addColumn('{{%member_category}}', 'domain_id', Schema::TYPE_INTEGER);
        $this->addColumn('{{%article_category}}', 'domain_id', Schema::TYPE_INTEGER);
        $this->addColumn('{{%info_category}}', 'domain_id', Schema::TYPE_INTEGER);
        $this->addColumn('{{%model_category}}', 'domain_id', Schema::TYPE_INTEGER);
        $this->addColumn('{{%project_category}}', 'domain_id', Schema::TYPE_INTEGER);
        $this->addColumn('{{%promo_category}}', 'domain_id', Schema::TYPE_INTEGER);

        //old
        $this->addColumn('{{%article}}', 'domain_id', Schema::TYPE_INTEGER);
        $this->addColumn('{{%info}}', 'domain_id', Schema::TYPE_INTEGER);
        $this->addColumn('{{%model}}', 'domain_id', Schema::TYPE_INTEGER);
        $this->addColumn('{{%project}}', 'domain_id', Schema::TYPE_INTEGER);
        $this->addColumn('{{%promo}}', 'domain_id', Schema::TYPE_INTEGER);

        //drop
        $this->dropColumn('{{%article}}', 'domain');
        $this->dropColumn('{{%info}}', 'domain');
        $this->dropColumn('{{%model}}', 'domain');
        $this->dropColumn('{{%project}}', 'domain');
        $this->dropColumn('{{%promo}}', 'domain');
    }

    public function down()
    {
        echo "m150827_054730_domain_column cannot be reverted.\n";

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