<?php

use yii\helpers\Html;
use yii\widgets\Activeform;
use frontend\models\Students;
use frontend\models\Books;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\Datepicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Borrowedbooks */
/* @var $form ActiveForm */
$students = ArrayHelper::map(Students::find()->all(), 'studentId', 'fullName');
$books = ArrayHelper::map(Books::find()->all(), 'bookId', 'bookName');
?>
<div class="assignbook">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'studentId')->dropDownList($students) ?>
        <?= $form->field($model, 'bookId')->dropDownList($books) ?>
        <?= $form->field($model, 'borrowDate')->widget(
          DatePicker::className(), [
            'inline' => false,
            'clientOptions' => [
              'autoclose' => true,
              'format' => 'yyyy-mm-dd'
            ]
          ]);?>
        <?= $form->field($model, 'returnDate')->widget(
            DatePicker::className(), [
                'inline' => false,
                'clientOptions' => [
                  'autoclose' => true,
                  'format' => 'yyyy-mm-dd'
                ]
              ]);?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- assignbook -->
