<?php
/**
 * Created by PhpStorm.
 * User: dastanaron
 * Date: 07.12.17
 * Time: 16:30
 */

namespace app\models;

use app\models\Lessons;

class CombinedModel extends Lessons
{

    public $lesson_name;
    public $group;
    public $teacher;
    public $time;


    public function attributeLabels()
    {
        return [
            'lesson_name' => 'Название урока',
            'group' => 'Группа',
            'time' => 'Время',
            'teacher' => 'Преподаватель',
        ];
    }

}