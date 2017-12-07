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
        $this->execute($this->fixtures());
    }

    public function down()
    {
        $this->dropTable($this->tablename);

    }

    private function fixtures()
    {
        $sql = "INSERT INTO $this->tablename (`id`, `name`, `teacher_id`, `created_at`, `updated_at`) VALUES
        (1, '7-8 лет', 1, '2017-12-07 09:58:46', '2017-12-07 09:58:46'),
        (2, '8-9 лет', 1, '2017-12-07 09:58:46', '2017-12-07 09:58:46'),
        (3, '5-7 лет', 2, '2017-12-07 09:59:13', '2017-12-07 09:59:13'),
        (4, '6 лет', 2, '2017-12-07 09:59:13', '2017-12-07 09:59:13'),
        (5, '9-11 лет', 3, '2017-12-07 09:59:50', '2017-12-07 09:59:50'),
        (6, '10-11 лет', 3, '2017-12-07 09:59:50', '2017-12-07 09:59:50'),
        (7, '12-14 лет', 4, '2017-12-07 10:00:10', '2017-12-07 10:00:10'),
        (8, '11-13 лет', 4, '2017-12-07 10:00:10', '2017-12-07 10:00:10');";
        return $sql;
    }
}
