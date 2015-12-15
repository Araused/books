<?php

use yii\db\Migration;

class m151215_162115_dummy_img extends Migration
{
    public function safeUp()
    {
        $this->update('{{%books}}', ['preview' => 'dummy.png']);
    }

    public function safeDown()
    {
        $this->update('{{%books}}', ['preview' => null]);
    }
}
