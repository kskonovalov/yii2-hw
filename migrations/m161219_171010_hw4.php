<?php

use yii\db\Migration;

class m161219_171010_hw4 extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->execute(file_get_contents(__DIR__ . '/hw4.sql'));
    }

    public function safeDown()
    {
    }
}
