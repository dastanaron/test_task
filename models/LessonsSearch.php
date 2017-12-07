<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lessons;
use \yii\db\Query;

/**
 * LessonsSearch represents the model behind the search form of `app\models\Lessons`.
 */
class LessonsSearch extends CombinedModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'group_id'], 'integer'],
            [['lesson_name', 'time', 'group', 'teacher'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        /*$query = Lessons::find();

         = new ActiveDataProvider([
            'query' => $query,
        ]);*/

        $query = (new Query())
            ->select([
                'lessons.name AS lesson_name',
                'lessons.time',
                'teachers.name',
                'teachers.surname',
                'groups.name AS group',
                'CONCAT_WS(" ", teachers.name, teachers.surname) AS teacher',
                'IF (lessons.time IS NULL, 0, 1) AS isFirst'
            ])
            ->from('lessons')
            ->leftJoin('groups', 'lessons.group_id = groups.id')
            ->leftJoin('teachers', 'groups.teacher_id = teachers.id')
            ->orderBy('isFirst DESC');

        $count = (new Query())
            ->select('COUNT(*)')
            ->from('lessons')
            ->leftJoin('groups', 'lessons.group_id = groups.id')
            ->leftJoin('teachers', 'groups.teacher_id = teachers.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => $count->count(),
            'sort' => ['attributes' => ['time']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query
            ->andFilterWhere(
                ['like', 'time', $this->time])
            ->andFilterWhere(
                ['like', 'lessons.name', $this->lesson_name]
            )
            ->andFilterWhere(
                ['like', 'groups.name', $this->group]
            )
            ->orFilterWhere(
                ['like', 'teachers.name', $this->teacher]
            )
            ->orFilterWhere(
                ['like', 'teachers.surname', $this->teacher]
            );
        return $dataProvider;
    }
}
