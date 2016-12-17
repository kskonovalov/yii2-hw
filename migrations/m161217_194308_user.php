<?php

use yii\db\Migration;

class m161217_194308_user extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->execute(file_get_contents(__DIR__ . '/user.sql'));
    }

    public function safeDown()
    {
    }

}
