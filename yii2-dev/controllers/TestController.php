<?php

namespace app\controllers;

use app\models\Subjects;
use Faker\Core\Number;
use yii\web\Controller;

class TestController extends Controller
{

    public function actionTest(){
        
        $subj = Subjects::findOne(['id'=>4]);

        echo'<pre>';
        var_dump($subj['starting_date']);
        var_dump($subj['ending_date']);
        var_dump($subj['duration']);

        $starting_year = (int)date("y",strtotime($subj['starting_date']));
        $ending_year = (int)date("y",strtotime($subj['ending_date']));

        $starting_month = (int)date("m",strtotime($subj['starting_date']));
        $ending_month = (int)date("m",strtotime($subj['ending_date']));

        var_dump($starting_month);
        var_dump($ending_month);

        $month = $starting_month;
        $year = $starting_year + 2000;

        $i = $month;

        for ($i=0; $i < (int)$subj['duration'] ; $i++) { 
            if($month > 12){
                $month = 1;
                $year++;
                echo "new pending payment for ". $year . "-" . ($month);
                echo '<br>';
            }else{
                echo "new pending payment for ". $year . "-" . $month;
                echo '<br>';
            };

                $month++;
                // var_dump('MES',$month);
        }




    }


}
