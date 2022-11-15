<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subjects".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property float|null $price
 * @property string|null $duration
 * @property int|null $teacher_id
 *
 * @property Payment[] $payments
 * @property User $teacher
 * @property UserHasGrade[] $userHasGrades
 * @property UserHasSubject[] $userHasSubjects
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subjects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'duration'], 'string'],
            [['price'], 'number'],
            [['teacher_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'duration' => 'Duration',
            'teacher_id' => 'Teacher ID',
        ];
    }

    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::class, ['for_subject' => 'id']);
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

    /**
     * Gets query for [[UserHasGrades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasGrades()
    {
        return $this->hasMany(UserHasGrade::class, ['on_subject' => 'id']);
    }

    /**
     * Gets query for [[UserHasSubjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasSubjects()
    {
        return $this->hasMany(UserHasSubject::class, ['subject_id' => 'id']);
    }
}
