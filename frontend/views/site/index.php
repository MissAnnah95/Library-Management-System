<?php
use yii\bootstrap\modal;
use frontend\models\Books;
use frontend\models\Borrowedbooks;
use frontend\models\Students;

/* @var $this yii\web\View */

$this->title = 'UNIQUE LIBRARY SYSTEM';
$totalBooks = Books::find()->asArray()->all();
$totalBorrowedbooks = Borrowedbooks::find()->asArray()->all();
$totalOverduebooks = Borrowedbooks::find()->asArray()->all();
$totalStudents = Students::find()->asArray()->all();
?>



      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
        	<div style="padding-top: 20px;">
        	   <button type="button" class="btn btn-block btn-success btn-lg assighnbook" style="width: 300px;"><i class="fa fa-plus" aria-hidden="true"></i> Assighn a Book</button>
            </div>
            <div style="text-align: center;">
                 <h2 class="box-title"><strong>BOOK ASSIGNMENTS</strong></h2>
            </div>
              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 300px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>Student Name</th>
                  <th>Book Name</th>
                  <th>Date taken</th>
                  <th>Return Date</th>                 
                  <th>Return Book</th>
                  <th>Book Status</th>
                </tr>
                <tr>
                  <td>John doe</td>
                  <td>John Doe</td>
                  <td>11-7-2014</td>
                  <td>11-7-2014</td>
                  <td><span class="btn btn-danger">Approved</span></td>                
                  <td><span class="label label-success">Approved</span></td>
            
                </tr>
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

      <?php
        Modal::begin([
            'header'=>'<h4>Assighn A Book</h4>',
            'id'=>'assignbook',
            'size'=>'modal-lg'
            ]);
        echo "<div id='assignbookContent'></div>";
        Modal::end();
      ?> 
