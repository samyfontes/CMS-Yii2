<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use webvimark\extensions\DateRangePicker\DateRangePicker;

/** @var yii\web\View $this */
/** @var app\models\Subjects $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="subjects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'duration')->dropDownList([6 => '6', 12 => '12',], ['prompt' => '']) ?>

    <?= $form->field($model, 'teacher_id')->textInput() ?>

    <?= $form->field($model, 'starting_date')->widget(\yii\jui\DatePicker::className(),[
        'model' => $model,
        'name' => 'starting_date',
        'attribute' => 'starting_date',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'ending_date')->widget(\yii\jui\DatePicker::className(),[
        'model' => $model,
        'name' => 'ending_date',
        'attribute' => 'ending_date',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>








    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>