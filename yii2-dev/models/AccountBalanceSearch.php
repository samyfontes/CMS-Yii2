<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AccountBalance;

/**
 * AccountBalanceSearch represents the model behind the search form of `app\models\AccountBalance`.
 */
class AccountBalanceSearch extends AccountBalance
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'for_user', 'payment_id'], 'integer'],
            [['amount'], 'number'],
            [['date'], 'safe'],
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
        $query = AccountBalance::find();

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
            'amount' => $this->amount,
            'for_user' => $this->for_user,
            'payment_id' => $this->payment_id,
            'date' => $this->date,
        ]);

        return $dataProvider;
    }
}
