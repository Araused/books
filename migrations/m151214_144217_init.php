<?php

use yii\db\Migration;

class m151214_144217_init extends Migration
{
    private $dummyLimits = [
        'books' => [
            'minId' => 1,
            'maxId' => 30,
        ],
        'authors' => [
            'minId' => 1,
            'maxId' => 10,
        ],
        'posix' => [
            'begin' => 0,
            'end' => 1450109423,
        ]
    ];

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'date_create' => $this->dateTime()->notNull(),
            'date_update' => $this->dateTime(),
            'preview' => $this->string(),
            'date' => $this->string()->notNull(),
            'author_id' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%authors}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string()->notNull(),
            'lastname' => $this->string()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_book_to_author', '{{%books}}', 'author_id', '{{%authors}}', 'id', 'CASCADE', 'CASCADE');

        $this->createDummyData();
    }

    public function createDummyData() {
        $limits = $this->dummyLimits;
        for ($i = $limits['authors']['minId']; $i < $limits['authors']['maxId'] + 1; $i++) {
            $this->insert('{{%authors}}', [
                'id' => $i,
                'firstname' => 'FirstName' . $i,
                'lastname' => 'LastName' . $i,
            ]);
        }

        for ($i = $limits['books']['minId']; $i < $limits['books']['maxId'] + 1; $i++) {
            $this->insert('{{%books}}', [
                'id' => $i,
                'name' => 'Book ' . $i,
                'date_create' => date('Y-m-d H:i:s'),
                'date_update' => null,
                'preview' => null,
                'date' => date('Y-m-d', rand($limits['posix']['begin'], $limits['posix']['end'])),
                'author_id' => rand($limits['authors']['minId'], $limits['authors']['maxId']),
            ]);
        }
    }

    public function safeDown()
    {
        $this->dropTable('{{%books}}');
        $this->dropTable('{{%authors}}');
    }
}
