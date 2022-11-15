<?php

use app\models\UserHasSubject;
use webvimark\modules\UserManagement\models\User;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Subject $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subjects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="subject-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Take Course'), 
            ['/user-has-subject/register-to-course', 'id' => $model->id], 
            ['class' => 'btn btn-info', 'style' => 'color: white;']
            ) ?>

        <?= Html::a(Yii::t('app', 'Teach Course'), 
            ['/subject/teach-subject', 'id' => $model->id], 
            ['class' => 'btn btn-success']
        ) ?>
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
        ],
    ]) ?>

    <br>
    <h2>Current Students</h2>

    <?=
    GridView::widget([
        'dataProvider' => $users,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'email',
            'email_confirmed',
            // [
            //     'label' => 'name',
            //     'value' => function($model){
            //         return '<b>'.($model["name"]).'</b>';
            //     },
            //     'format' => 'raw',
            // ],
        ],
    ]) 
    
    ?>


</div>
