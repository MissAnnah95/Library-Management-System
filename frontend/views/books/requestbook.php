<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use frontend\models\Books;


/* @var $this yii\web\View */
/* @var $model frontend\models\Books */
/* @var $form ActiveForm */


?>
<div class="requestbook">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'bookName') ?>
        <?= $form->field($model, 'referenceNumber')->textInput(['disabled' => true]) ?>
        <?= $form->field($model, 'publisher')->textInput(['disabled' => true]) ?>
        <?= $form->field($model, 'status')->textInput(['disabled' => true]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- requestbook -->
