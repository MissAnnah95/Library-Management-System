<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use frontend\models\Students;
use frontend\models\Books;

/* @var $this yii\web\View */
/* @var $model frontend\models\Borrowedbooks */
/* @var $form yii\widgets\ActiveForm */
$students = ArrayHelper::map(Students::find() ->all(),'studentId', 'fullName');
$books = ArrayHelper::map(Books::find()->where(['status'=>0])->all(),'bookId', 'bookName');
?>

<div class="borrowedbooks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'studentId')->dropDownList($students) ?>

    <?= $form->field($model, 'bookId')->dropDownList($books) ?>

    <?= $form->field($model, 'borrowDate')->hiddeninput(['value'=>date ('yy/m/d')])->label(false) ?>

    <?= $form->field($model, 'expectedReturn')->widget(
        DatePicker::className(), [
            'inline' => false,
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);?>

  

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
