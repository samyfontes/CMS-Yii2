<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Payments $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="payments-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-md-8\">{input}</div>\n<div class=\"col-md\">{error}</div>",
            'labelOptions' => ['class' => 'col-md control-label', 'style' => 'text-allign: center;'],
        ],
    ]); ?>

    <?= $form->field($model, 'from_user')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'for_subject')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
