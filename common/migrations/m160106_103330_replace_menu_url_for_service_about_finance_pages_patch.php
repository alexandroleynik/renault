<?php

use yii\db\Migration;

class m160106_103330_replace_menu_url_for_service_about_finance_pages_patch extends Migration
{
    public function up()
    {
        $sql = "UPDATE about_page SET body = REPLACE(body, '/about-page/', '/about-company/');
                UPDATE service_page SET body = REPLACE(body, '/service-page/', '/service/');
                UPDATE finance_page SET body = REPLACE(body, '/finance-page/', '/finance/');

                UPDATE block SET body = REPLACE(body, '/finance-page/', '/finance/');
                UPDATE block SET body = REPLACE(body, '/service-page/', '/service/');
                UPDATE block SET body = REPLACE(body, '/about-page/', '/about-company/');";

        $this->execute($sql);
    }

    public function down()
    {
        $sql = "UPDATE about_page SET body = REPLACE(body, '/about-company/', '/about-page/');
                UPDATE service_page SET body = REPLACE(body, '/service/', '/service-page/');
                UPDATE finance_page SET body = REPLACE(body, '/finance/', '/finance-page/');

                UPDATE block SET body = REPLACE(body, '/finance/', '/finance-page/');
                UPDATE block SET body = REPLACE(body, '/service/', '/service-page/');
                UPDATE block SET body = REPLACE(body, '/about-company/', '/about-page/');";

        $this->execute($sql);
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
