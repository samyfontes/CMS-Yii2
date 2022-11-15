<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_has_grade".
 *
 * @property int $id
 * @property int $user_id
 * @property float|null $grade
 * @property int $on_subject
 *
 * @property Subjects $onSubject
 * @property User $user
 */
class UserHasGrade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_has_grade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'on_subject'], 'required'],
            [['user_id', 'on_subject'], 'integer'],
            [['grade'], 'number'],
            [['on_subject'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::class, 'targetAttribute' => ['on_subject' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'grade' => 'Grade',
            'on_subject' => 'On Subject',
        ];
    }

    /**
     * Gets query for [[OnSubject]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOnSubject()
    {
        return $this->hasOne(Subject::class, ['id' => 'on_subject']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
