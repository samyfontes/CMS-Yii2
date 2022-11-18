<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%account_balance}}".
 *
 * @property int $id
 * @property float|null $amount
 * @property int $for_user
 * @property int $payment_id
 * @property string|null $date
 *
 * @property User $forUser
 * @property Payment $payment
 */
class AccountBalance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%account_balance}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount'], 'number'],
            [['for_user', 'payment_id'], 'required'],
            [['for_user', 'payment_id'], 'integer'],
            [['date'], 'safe'],
            [['for_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['for_user' => 'id']],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Payment::class, 'targetAttribute' => ['payment_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => 'Amount',
            'for_user' => 'For User',
            'payment_id' => 'Payment ID',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[ForUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForUser()
    {
        return $this->hasOne(User::class, ['id' => 'for_user']);
    }

    /**
     * Gets query for [[Payment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(Payment::class, ['id' => 'payment_id']);
    }
}
