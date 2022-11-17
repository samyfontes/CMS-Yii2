<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Payments;

/**
 * PaymentSearch represents the model behind the search form of `app\models\Payments`.
 */
class PaymentSearch extends Payments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'from_user', 'for_subject'], 'integer'],
            [['amount'], 'number'],
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
        $query = Payments::find();

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
            'from_user' => $this->from_user,
            'amount' => $this->amount,
            'for_subject' => $this->for_subject,
        ]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied for specific user_id
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchUserPayments($user_id)
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Payments::find()->where(['from_user' => $user_id]),
        ]);

        return $dataProvider;
    }
}
