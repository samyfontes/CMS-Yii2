<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AccountBalance $model */

$this->title = Yii::t('app', 'Update Account Balance: {name}', [
    'name' => $model->item_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Account Balances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->item_id, 'url' => ['view', 'item_id' => $model->item_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="account-balance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
