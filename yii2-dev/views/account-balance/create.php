<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AccountBalance $model */

$this->title = Yii::t('app', 'Create Account Balance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Account Balances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-balance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
