<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\StudentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="students-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'studentId') ?>

    <?= $form->field($model, 'userId') ?>

    <?= $form->field($model, 'fullName') ?>

    <?= $form->field($model, 'idNumber') ?>

    <?= $form->field($model, 'regNumber') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
