<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $id
 * @property int $from_user
 * @property float|null $amount
 * @property int $for_subject
 *
 * @property Subject $forSubject
 * @property User $fromUser
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from_user', 'for_subject'], 'required'],
            [['from_user', 'for_subject'], 'integer'],
            [['amount'], 'number'],
            [['for_subject'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::class, 'targetAttribute' => ['for_subject' => 'id']],
            [['from_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['from_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_user' => 'From User',
            'amount' => 'Amount',
            'for_subject' => 'For Subject',
        ];
    }

    /**
     * Gets query for [[ForSubject]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForSubject()
    {
        return $this->hasOne(Subject::class, ['id' => 'for_subject']);
    }

    /**
     * Gets query for [[FromUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFromUser()
    {
        return $this->hasOne(User::class, ['id' => 'from_user']);
    }
}
