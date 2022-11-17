<?php

use app\models\UserHasSubject;
use webvimark\modules\UserManagement\models\User;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Subjects $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="subjects-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <br>
    <h2>User state</h2>

    <?php
    
        $user_id = Yii::$app->user->id ;
        $user_subjects = UserHasSubject::findAll(['user_id' => $user_id]);
        $user_state = FALSE;

        foreach ($user_subjects as $subj) {

            $subj_id = $subj->attributes['subject_id'] ;

            if($subj_id === $model->id){
                $user_state = TRUE;
            }
        }

        if($user_state){
            echo Html::tag('p','User is already registered on the course');
        }else{
            echo Html::tag('p','User is not registered on the course yet');
        };
    ?>

    <br>




    <p>
        
    <? 
        if(User::hasRole('admin' || 'superadmin')){
        echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }?>
        
        <? 
        if(User::hasRole('admin' || 'superadmin')){
            echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ;
        }?>

        <?  
            if($user_state === FALSE){
                echo Html::a(Yii::t('app', 'Take Course'), 
                ['/user-has-subject/register-to-course', 'id' => $model->id], 
                ['class' => 'btn btn-info', 'style' => 'color: white;']
            );
            };
        ?>

        <? 
            
            if(Yii::$app->user->identity->hasRole('teacher')){
                if($model->teacher_id === NULL ){
                    echo Html::a(Yii::t('app', 'Teach Course'), 
                    ['/subject/teach-subject', 'id' => $model->id], 
                    ['class' => 'btn btn-success']
                    ) ;
                }
            }
        ?>
    </p>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'price',
            'duration',
            'teacher_id',
            'starting_date',
            'ending_date',
        ],
    ]) ?>


    <br>
    <h2>Current Students</h2>

    <?=
    GridView::widget([
        'dataProvider' => $users,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'user.username',
            'user.email'
        ],
    ]) 
    
    ?>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

</div>
