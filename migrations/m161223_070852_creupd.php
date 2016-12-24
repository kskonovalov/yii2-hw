<?php

use yii\db\Migration;

class m161223_070852_creupd extends Migration
{
    public function up()
    {
        $this->addColumn('products', 'created', 'DATETIME');
        $this->addColumn('products', 'updated', 'DATETIME');
    }

    public function down()
    {
        $this->dropColumn('products', 'created');
        $this->dropColumn('products', 'updated');
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
