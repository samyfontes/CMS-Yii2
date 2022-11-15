<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserHasSubject $model */

$this->title = 'Create User Has Subject';
$this->params['breadcrumbs'][] = ['label' => 'User Has Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-has-subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
