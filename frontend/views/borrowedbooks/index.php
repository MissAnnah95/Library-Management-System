<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\modal;
use frontend\models\Books;
use frontend\models\Students;
use yii\helpers\ArrayHelper;
use frontend\models\Borrowedbooks;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BorrowedbooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$totalBooks = Books::find()->asArray()->all();
$borrowedbooks = Borrowedbooks::find()->asArray()->all();
$totalStudents = Students::find()->asArray()->all();
$overdue = Borrowedbooks::find()->where('expectedReturn < '.date('yy/m/d'))->andwhere(['actualReturnDate'=>NULL])->asArray()->all();


$this->title = 'UNIQUE LIBRARY';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">TOTAL BOOKS</span>
              <span class="info-box-number"><?=count($totalBooks)?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="fa fa-book"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">BORROWED BOOKS</span>
              <span class="info-box-number"><?=count($borrowedbooks)?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-orange"><i class="fa fa-book"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">OVERDUE BOOKS</span>
              <span class="info-box-number"><?=count($overdue)?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">TOTAL STUDENTS</span>
              <span class="info-box-number"><?=count($totalStudents)?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div> 
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
        	<div style="padding-top: 20px;">
          <?php if(Yii::$app->user->can('librarian')){ ?>
                <button type="button" class="btn btn-primary assignbook" aria-controls="example1"><span class="fa fa-plus"> Assign a Book</span></button>
              <?php }?>
              <?php if(Yii::$app->user->can('student')){ ?>
                <button type="button" class="btn btn-primary borrowbook" aria-controls="example1"><span class="fa fa-plus"> Borrow Book</span></button>
              <?php }?>
            </div>
            <div style="text-align: center;">
                 <h2 class="box-title"><strong>BOOK ASSIGNMENTS</strong></h2>
            </div>
              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 300px;">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <?php if(Yii::$app->user->can('librarian')){ ?>
            <div class="box-body table-responsive no-padding">
                            <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                             //'bbId',
                        [
                          'attribute' => 'studentId',
                          'value' => function ($dataProvider) {
                              $studentName = Students::find()->where(['studentId'=>$dataProvider->studentId])->One();
                              return $studentName->fullName;
                          },
                      ],
                      [
                          'attribute' => 'bookId',
                          'value' => function ($dataProvider) {
                          $studentName = Books::find()->where(['bookId'=>$dataProvider->bookId])->One();
                          return $studentName->bookName;
                          },
                      ],
                      [
                          'attribute' => 'borrowDate',
                          'value' => function ($dataProvider) {
                              $date = new DateTime($dataProvider->borrowDate);
                              return $date->format('F j, Y,');
                          },
                      ],
                      [
                          'attribute' => 'expectedReturn',
                          'value' => function ($dataProvider) {
                          $date = new DateTime($dataProvider->expectedReturn);
                          return $date->format('F j, Y,');
                          },
                      ],
                      'actualReturnDate',
                      [
                          'label'=>'Return Book',
                          'format' => 'raw',
                          'value' => function ($dataProvider) {
                          return '<span val="'.$dataProvider->bbId.'"class="btn btn-danger returnbook">Return</span>';
                          },
                          
                      ],
                      [
                        'label'=>'Status',
                        'format' => 'raw',
                        'value' => function ($dataProvider) {
                            $bookStatus = Books::find()->where(['bookId'=>$dataProvider->bookId])->One();
                            if($bookStatus->status==0){
                              $status = 'Available';
                              return '<span class="btn btn-info">'.$status.'</span>';
                            }elseif($bookStatus->status==1){
                              $status = 'Issued';
                              return '<span class="btn btn-success">'.$status.'</span>';
                            }elseif($bookStatus->status==2){
                              $status = 'Pending';
                              return '<span class="btn btn-danger">'.$status.'</span>';
                            }
                              
                            //return '<span class="btn btn-info">'.$status.'</span>';
                          },
                          
                      ],
                      //'actualReturnDate',
          
                      ['class' => 'yii\grid\ActionColumn'],
                  ],
              ]); ?>
            </div>
            <?php }?>
            <!-- /.box-body -->
            <?php if(Yii::$app->user->can('student')){ ?>
            <div class="box-body table-responsive no-padding">
                            <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                             //'bbId',
                        [
                          'attribute' => 'studentId',
                          'value' => function ($dataProvider) {
                              $studentName = Students::find()->where(['studentId'=>$dataProvider->studentId])->One();
                              return $studentName->fullName;
                          },
                      ],
                      [
                          'attribute' => 'bookId',
                          'value' => function ($dataProvider) {
                          $studentName = Books::find()->where(['bookId'=>$dataProvider->bookId])->One();
                          return $studentName->bookName;
                          },
                      ],
                      [
                          'attribute' => 'borrowDate',
                          'value' => function ($dataProvider) {
                              $date = new DateTime($dataProvider->borrowDate);
                              return $date->format('F j, Y,');
                          },
                      ],
                      [
                          'attribute' => 'expectedReturn',
                          'value' => function ($dataProvider) {
                          $date = new DateTime($dataProvider->expectedReturn);
                          return $date->format('F j, Y,');
                          },
                      ],
                      'actualReturnDate',                      
                      [
                        'label'=>'Status',
                        'format' => 'raw',
                        'value' => function ($dataProvider) {
                            $bookStatus = Books::find()->where(['bookId'=>$dataProvider->bookId])->One();
                            if($bookStatus->status==0){
                              $status = 'Available';
                              return '<span class="btn btn-info">'.$status.'</span>';
                            }elseif($bookStatus->status==1){
                              $status = 'Issued';
                              return '<span class="btn btn-success">'.$status.'</span>';
                            }elseif($bookStatus->status==2){
                              $status = 'Pending';
                              return '<span class="btn btn-danger">'.$status.'</span>';
                            }
                              
                            //return '<span class="btn btn-info">'.$status.'</span>';
                          },
                          
                      ],
                      //'actualReturnDate',
          
                      ['class' => 'yii\grid\ActionColumn'],
                  ],
              ]); ?>
            </div>
            <?php }?>
          </div>
          <!-- /.box -->
        </div>
      </div>







<?php
  Modal::begin([
      'header'=>'<h4>Return Book</h4>',
      'id'=>'returnbook',
      'size'=>'modal-md'
      ]);
  echo "<div id='returnbookContent'></div>";
  Modal::end();
?>

<?php
        Modal::begin([
            'header'=>'<h4>Assighn A Book</h4>',
            'id'=>'assignbook',
            'size'=>'modal-lg'
            ]);
        echo "<div id='assignbookContent'></div>";
        Modal::end();
      ?> 
