<?php

use yii\db\Migration;

/**
 * Class m171207_093515_groups
 */
class m171207_093515_groups extends Migration
{
    public $tablename = 'groups';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tablename, [

            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'teacher_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->null(),
            'updated_at' => $this->timestamp()->null(),

        ], $tableOptions);

        $this->execute('ALTER TABLE '.$this->tablename.' CHANGE `updated_at` `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;');
        $this->execute('ALTER TABLE '.$this->tablename.' CHANGE `created_at` `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;');
    }

    public function down()
    {
        $this->dropTable($this->tablename);

    }
}
