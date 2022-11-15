<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserHasGrade $model */

$this->title = 'Create User Has Grade';
$this->params['breadcrumbs'][] = ['label' => 'User Has Grades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-has-grade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
