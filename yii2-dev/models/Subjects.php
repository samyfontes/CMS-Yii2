<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * This is the model class for table "subjects".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property float|null $price
 * @property string|null $duration
 * @property int|null $teacher_id
 * @property string|null $starting_date
 * @property string|null $ending_date
 *
 * @property Payment[] $payments
 * @property User $teacher
 * @property UserHasGrade[] $userHasGrades
 * @property UserHasSubject[] $userHasSubjects
 */
class Subjects extends \yii\db\ActiveRecord
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
            [['starting_date', 'ending_date'], 'safe'],
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
            'starting_date' => 'Starting Date',
            'ending_date' => 'Ending Date',
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

    public static function getUsersOnSubject($subjectId)
    {

        $query = UserHasSubject::find()->where(['subject_id'=>$subjectId]);


        $provider =  new ActiveDataProvider([
            'query' => $query,
        ]);
        

        // filters... 

        return $provider;
    }

    /**
     * Returns the Finishing date of a subject
     * 
     * @return string
     */
    public function getFinishingDate($starting_date, $duration){
        
        $starting_year = (int)date("y",strtotime($starting_date)) + 2000;
        $starting_month = (int)date("m",strtotime($starting_date));
        $starting_day = (int)date("d",strtotime($starting_date));

        if($duration === 12){

            $ending_year = $starting_year + 1;
            $ending_month = $starting_month;

        }else{
            
            $ending_year = $starting_year;
            $ending_month = $starting_month + $duration;
            
            if($ending_month > 12){
            
                $ending_month = $ending_month - 13 ;
                $ending_year = $starting_year + 1 ;

            }
        }

        $finishing_date = $ending_year . "-" . $ending_month  . "-" . $starting_day . " 00:00:00" ;
        
        return date($finishing_date) ;
    }
}
