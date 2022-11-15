<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UserHasSubject $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-has-subject-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-md-8\">{input}</div>\n<div class=\"col-md\">{error}</div>",
            'labelOptions' => ['class' => 'col-md control-label', 'style' => 'text-allign: center;'],
        ],
    ]); ?>

     <?= $form->field($model, 'user_id')->textInput() ?> 
    <!-- <= $this->render('@app/views/user-has-subject/_find-with-autocomplete', ['form' => $form, 'model' => $model, 'attribute' => 'user_id']) ?> -->


     <?= $form->field($model, 'subject_id')->textInput() ?> 


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
