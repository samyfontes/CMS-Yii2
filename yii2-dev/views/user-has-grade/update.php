<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserHasGrade $model */

$this->title = 'Update User Has Grade: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Has Grades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-has-grade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
