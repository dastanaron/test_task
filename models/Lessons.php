<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lessons".
 *
 * @property int $id
 * @property string $name
 * @property int $group_id
 * @property string $time
 * @property string $created_at
 * @property string $updated_at
 */
class Lessons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lessons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'group_id'], 'required'],
            [['group_id'], 'integer'],
            [['time', 'created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'group_id' => 'Group ID',
            'time' => 'Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
