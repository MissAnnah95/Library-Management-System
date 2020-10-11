<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\models\Books;
use yii\bootstrap\modal;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Books List';
$this->params['breadcrumbs'][] = $this->title;
?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="box box-info">
            <div class="box-header with-border">
              <div>
                <?php if(Yii::$app->user->can('librarian')){ ?>
              <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
            <?php }?>
            <?php if(Yii::$app->user->can('student')){ ?>              
            <?php }?>
            </div>
            <div style="text-align: center;">
              <h1><?= Html::encode($this->title) ?></h1>
            </div>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <?php if(Yii::$app->user->can('librarian')){ ?>
            <?php Pjax::begin(); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'bookId',
                        'bookName',
                        'referenceNumber',
                        'publisher',
                        //'status',
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

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
              <?php Pjax::end(); ?>
              <?php }?>
              <?php if(Yii::$app->user->can('student')){ ?>
            <?php Pjax::begin(); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'bookId',
                        'bookName',
                        'referenceNumber',
                        'publisher',
                        //'status',
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
                        [
                          'label'=>'Borrow Book',
                          'format' => 'raw',
                          'value' => function ($dataProvider) {
                          return '<span val='.$dataProvider->bookId.' class="btn btn-success requestbook">Borrow Book</span>';
                            },
                        ],

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
              <?php Pjax::end(); ?>
              <?php }?>
              </div>
            </div>
            <!-- /.box-body -->
          </div>

          <?php
  Modal::begin([
      'header'=>'<h4>Request Book</h4>',
      'id'=>'requestbook',
      'size'=>'modal-md'
      ]);
  echo "<div id='requestbookContent'></div>";
  Modal::end();
?>

         
