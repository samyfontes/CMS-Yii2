<?php

namespace app\controllers;

use app\models\Payments;
use app\models\Subjects;
use Faker\Core\Number;
use Yii;
use yii\web\Controller;

class TestController extends Controller
{

    public function actionTest(){
        
        $subj = Subjects::findOne(['id'=>5]);

        echo '<pre>';
        // var_dump($subj['starting_date']);
        // var_dump($subj['ending_date']);
        // var_dump($subj['duration']);

        $starting_year = (int)date("y",strtotime($subj['starting_date']));
        $ending_year = (int)date("y",strtotime($subj['ending_date']));
        $day = (int)date("d",strtotime($subj['starting_date']));

        $starting_month = (int)date("m",strtotime($subj['starting_date']));
        $ending_month = (int)date("m",strtotime($subj['ending_date']));

        // var_dump($starting_month);
        // var_dump($ending_month);

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

                // $pmnt->save();

                Yii::$app->session->addFlash('success',  'new pending payment for '. $pmnt->date);

            }else{

                $pmnt_date = $year . '-' . $month . '-' . $day ;

                $pmnt = new Payments;

                $pmnt->from_user = Yii::$app->user->identity->id;
                $pmnt->amount = $subj->price;
                $pmnt->for_subject = $subj->id;
                $pmnt->status = 'pending';
                $pmnt->date = $pmnt_date;

                // $pmnt->save();

                Yii::$app->session->addFlash('success',  'new pending payment for '. $pmnt->date);

            };
            $month++;
        }
    }

    public function actionMoreTests(){

        $subj = Subjects::findOne(['id'=>6]);

        $subj->getFinishingDate($subj['starting_date'], $subj['duration']);
        
        die();
    }


}
