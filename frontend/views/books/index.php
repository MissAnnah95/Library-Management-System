<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
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
              <?= Html::a('Borrow Books', ['requestbook'], ['class' => 'btn btn-success']) ?>
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
                        'status',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
              <?php Pjax::end(); ?>
            </div>
            <!-- /.box-body -->
          </div>

         
