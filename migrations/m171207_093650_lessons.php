<?php

use yii\db\Migration;

/**
 * Class m171207_093650_lessons
 */
class m171207_093650_lessons extends Migration
{
    public $tablename = 'lessons';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tablename, [

            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'group_id' => $this->integer()->notNull(),
            'time' => $this->timestamp()->null(),
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
        $sql = "INSERT INTO $this->tablename (`id`, `name`, `group_id`, `time`, `created_at`, `updated_at`) VALUES
        (1, 'Что такое программирование?', 1, NULL, '2017-12-07 10:01:36', '2017-12-07 10:01:36'),
        (2, 'Современные языки программирования', 7, '2017-12-18 09:00:00', '2017-12-07 10:01:36', '2017-12-07 10:01:36'),
        (3, 'Ситаксис JavaScript', 6, '2017-12-28 14:00:00', '2017-12-07 10:02:45', '2017-12-07 10:02:45'),
        (4, 'Основные функции php', 8, NULL, '2017-12-07 10:02:45', '2017-12-07 10:02:45'),
        (5, 'Принцип построения программы', 3, NULL, '2017-12-07 10:03:31', '2017-12-07 10:03:31'),
        (6, 'Что из себя представляет файл', 2, '2018-01-17 15:00:00', '2017-12-07 10:03:31', '2017-12-07 10:03:31'),
        (7, 'Операторы, циклы, сравнение', 5, '2018-02-15 08:00:00', '2017-12-07 10:04:35', '2017-12-07 10:04:35');";
        return $sql;
    }
}
