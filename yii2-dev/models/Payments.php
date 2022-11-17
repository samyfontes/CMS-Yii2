<?php

namespace app\models;

use Yii;
use app\models\Subjects;

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
            [['for_subject'], 'exist', 'skipOnError' => true, 'targetClass' => Subjects::class, 'targetAttribute' => ['for_subject' => 'id']],
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

    /**
     * generates pending payments when a user registers 
     * to take a course 
     */
    public static function createPendingPayments($subj_id)
    {

        
        $subj = Subjects::findOne(['id'=>$subj_id]);

        $starting_year = (int)date("y",strtotime($subj['starting_date']));
        $ending_year = (int)date("y",strtotime($subj['ending_date']));
        $day = (int)date("d",strtotime($subj['starting_date']));

        $starting_month = (int)date("m",strtotime($subj['starting_date']));
        $ending_month = (int)date("m",strtotime($subj['ending_date']));

        $month = $starting_month;
        $year = $starting_year + 2000;
        $pmnt_date = $year . '-' . $month . '-' . $day ;
        

        for ($i=0; $i < (int)$subj['duration'] ; $i++) { 

            if($month > 12){

                $month = 1;
                $year++;

                $pmnt_date = $year . '-' . $month . '-' . $day ;

                $pmnt = new Payments;

                $pmnt->from_user = Yii::$app->user->identity->id;
                $pmnt->amount = $subj->price;
                $pmnt->for_subject = $subj->id;
                $pmnt->status = 'pending';
                $pmnt->date = $pmnt_date;

                $pmnt->save();

                Yii::$app->session->addFlash('success',  'new pending payment for '. $pmnt->date);

            }else{

                $pmnt_date = $year . '-' . $month . '-' . $day ;

                $pmnt = new Payments;

                $pmnt->from_user = Yii::$app->user->identity->id;
                $pmnt->amount = $subj->price;
                $pmnt->for_subject = $subj->id;
                $pmnt->status = 'pending';
                $pmnt->date = $pmnt_date;

                $pmnt->save();

                Yii::$app->session->addFlash('success',  'new pending payment for '. $pmnt->date);

            };
            $month++;
        }

    }
}
