<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserHasSubject $model */

$this->title = 'Update User Has Subject: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Has Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-has-subject-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
