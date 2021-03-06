<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Books;
use frontend\models\BooksSearch;
use frontend\models\Bookauthor;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Borrowedbooks;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BooksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Books model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Books();
        $bookAuthor = New Bookauthor();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $authorId = Yii::$app->request->post()['Bookauthor']['authorId'];
            $bookId = $model->bookId;
            if($this->bookauthors($authorId,$bookId)){
                return $this->redirect(['index']);
            }
            return $this->redirect(['create']);
        }
        return $this->render('create', [
            'model' => $model,
            'bookAuthor'=>$bookAuthor
        ]);
    }

    public function actionAddauthor()
    {
        $model = new \frontend\models\Authors();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                return $this->redirect(['create']);
            }
        }
        
        return $this->renderAjax('addauthor', [
            'model' => $model,
        ]);
    }

    public function bookauthors($authorId,$bookId){
        $model = New BookAuthor();
        $data= array('BookAuthor'=>['bookId'=>$bookId,'authorId'=>$authorId]);
        
        if($model->load($data) && $model->save()){
            return true;
        }
        return false;
    }
    // modal for students to request books.

    public function actionRequestbook()
    {
        $model = new Borrowedbooks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->afterBookRequest($model->bookId);
                // form inputs are valid, do something here
                return $this->redirect(['index']);
            
        }

        return $this->renderAjax('requestbook', [
            'model' => $model,
        ]);
    }

    public function afterBookRequest($bookId){
        $command = \Yii::$app->db->createCommand('UPDATE books SET status=2 WHERE bookId='.$bookId);
        $command->execute();
        return true;
      }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bookId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
