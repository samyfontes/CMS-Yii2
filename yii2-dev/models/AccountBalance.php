<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%account_balance}}".
 *
 * @property int $item_id
 * @property float|null $amount
 * @property int $teacher_id
 * @property int $payment_id
 * @property string|null $date
 *
 * @property Payment $payment
 * @property User $teacher
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
            [['teacher_id', 'payment_id'], 'required'],
            [['teacher_id', 'payment_id'], 'integer'],
            [['date'], 'safe'],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Payment::class, 'targetAttribute' => ['payment_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'amount' => 'Amount',
            'teacher_id' => 'Teacher ID',
            'payment_id' => 'Payment ID',
            'date' => 'Date',
        ];
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

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(User::class, ['id' => 'teacher_id']);
    }

    public function newItem($pmnt_id)
    {
        $payment = Payments::findOne(['id'=>$pmnt_id]);

        $teacher_id = Subjects::sele ;

        if ($payment->status === 'closed') {
        
            $teacher_commission = new AccountBalance();
            $teacher_commission->amount = $payment->amount * 0.8 ; 
            var_dump($teacher_commission);
        
        }

    }
}
