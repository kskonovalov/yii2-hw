<?php

use yii\db\Migration;

class m161229_111218_categories extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->execute(file_get_contents(__DIR__ . '/categories.sql'));
    }

    public function safeDown()
    {
        echo "m161229_111218_categories cannot be reverted.\n";
        return false;
    }

}
