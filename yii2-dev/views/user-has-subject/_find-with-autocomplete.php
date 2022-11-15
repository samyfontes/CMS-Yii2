<?php

use app\models\User;
use webvimark\modules\UserManagement\models\User as ModelsUser;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\helpers\Html;

$user_id = ($attribute ? $attribute : 'user_id' );
$user = ModelsUser::findOne($model->$user_id);
$name = empty($model->$user_id) ? '' : $user->username ;

//Plugin options
$pluginOptions = [
    'allowClear' => true,
    'minimumInputLength' => 1,
    'ajax' => [
        'url' => Url::to(['/users/find-by-name']),
        'dataType' => 'json',
        'data' => new JsExpression('function(params) { return {name:params.term, id:$(this).val()}; }')
    ],
    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
    'templateResult' => new JsExpression('function(user) { return user.text; }'),
    'templateSelection' => new JsExpression('function (user) { return user.text; }'),
    'cache' => true
];

//Con ActiveForm
if(isset($form)){
    echo $form->field($model, $user_id)->label(isset($label) ? $label : null)->widget(Select2::classname(), [
        'initValueText' => $name,
        'options' => ['placeholder' => Yii::t('app', 'Search')],
        'pluginOptions' => $pluginOptions,
    ]);
    

//Sin ActiveForm
}else{
    echo Select2::widget([
        'model' => $model,
        'attribute' => $user_id,
        'initValueText' => $name,
        'options' => ['placeholder' => Yii::t('app', 'Search')],
        'pluginOptions' => $pluginOptions,
    ]);
}