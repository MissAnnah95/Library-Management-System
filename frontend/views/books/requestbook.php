<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Books;
use frontend\models\Students;
use frontend\models\Borrowedbooks;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

// $bookList = Books::find()->asArray()->all();
// $bookList = ArrayHelper::map(Books::find()->orderBy('book_name')->asArray()->all() 'book_id', 'book_name'),['prompt' => 'Select books', 'multiple' => true, 'selected' => 'selected']);
/* @var $this yii\web\View */
/* @var $model frontend\models\Books */
/* @var $form ActiveForm */
$studentId = Students::find()->where(['userId'=>Yii::$app->user->id])->one();
$books = ArrayHelper::map(Books::find()->where(['status'=>0])->all(), 'bookId', 'bookName');
?>
<div class="requestbook">
    <?php $form = ActiveForm::begin(['id' => 'request-book']); ?>
        <?= $form->field($model, 'borrowDate')->hiddenInput(['value'=>date('yy/m/d')])->label(false) ?>
        <?= $form->field($model, 'studentId')->hiddenInput(['value'=>$studentId->studentId])->label(false) ?>
        <?= $form->field($model, 'bookId')->dropDownList($books) ?>
        <?= $form->field($model, 'expectedReturn')->widget(
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
</div><!-- requestbook -->