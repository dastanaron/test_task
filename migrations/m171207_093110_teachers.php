<?php

use yii\db\Migration;

/**
 * Class m171207_093110_teachers
 */
class m171207_093110_teachers extends Migration
{

    public $tablename = 'teachers';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tablename, [

            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
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
        $sql = "INSERT INTO $this->tablename (`id`, `name`, `surname`, `created_at`, `updated_at`) VALUES
        (1, 'Иван', 'Иванов', '2017-12-07 09:55:10', '2017-12-07 09:55:10'),
        (2, 'Сергей', 'Сидоров', '2017-12-07 09:55:10', '2017-12-07 09:55:30'),
        (3, 'Татьяна', 'Власова', '2017-12-07 09:55:57', '2017-12-07 09:55:57'),
        (4, 'Надежда', 'Колеухина', '2017-12-07 09:55:57', '2017-12-07 09:55:57');";

        return $sql;

    }

}
