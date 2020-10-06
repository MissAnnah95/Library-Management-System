<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\helpers\ArrayHelper;
use frontend\models\Students;

/* @var $this yii\web\View */
/* @var $model frontend\models\Students */
/* @var $form yii\widgets\ActiveForm */
$users = ArrayHelper::map(User::find()->all(), 'id', 'username');
$students = ArrayHelper::map(Students::find() ->all(),'studentId', 'fullName');
?>

<div class="students-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userId')->dropDownList($users) ?>

    <?= $form->field($model, 'fullName')->dropDownList($students) ?>

    <?= $form->field($model, 'idNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'regNumber')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
