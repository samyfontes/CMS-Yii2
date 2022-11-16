<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Subjects;

/**
 * SubjectSearch represents the model behind the search form of `app\models\Subjects`.
 */
class SubjectSearch extends Subjects
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'teacher_id'], 'integer'],
            [['name', 'description', 'duration', 'starting_date', 'ending_date'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Subjects::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'teacher_id' => $this->teacher_id,
            'starting_date' => $this->starting_date,
            'ending_date' => $this->ending_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'duration', $this->duration]);

        return $dataProvider;
    }
}
