<?php

use app\models\AccountBalance;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\AccountBalanceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'My balance';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-balance-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- // TODO: descomentar para agregar funcionalidad de dejar el account_balance en cero a modo de "extraccion" -->
    
    <!-- <p>
        <= Html::a(Yii::t('app', 'Create Account Balance'), ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'item_id',
            'amount',
            'teacher_id',
            'payment_id',
            'date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AccountBalance $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>