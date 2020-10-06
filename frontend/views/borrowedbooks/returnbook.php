<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Students;
use frontend\models\Books;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model frontend\models\BorrowedBook */
/* @var $form yii\widgets\ActiveForm */
$sudents = ArrayHelper::map(Students::find()->all(), 'studentId', 'fullName');
$books = ArrayHelper::map(Books::find()->all(), 'bookId', 'bookName');
?>
<div class="borrowed-book-form">
    <?php $form = ActiveForm::begin(['id' => 'bb-create']); ?>
    
    
    <?= $form->field($model, 'studentId')->dropDownList($sudents,['disabled' => true]) ?>
    <?= $form->field($model, 'bookId')->dropDownList($books,['disabled' => true]) ?>
    
    <?= $form->field($model, 'borrowDate')->textInput(['disabled' => true]) ?>
    <?= $form->field($model, 'expectedReturn')->textInput(['disabled' => true]) ?>
     <?= $form->field($model, 'actualReturnDate')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter Expected Return date ...'],
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
     ?>
    <div class="form-group">
        <?= Html::submitButton('Confirm', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>