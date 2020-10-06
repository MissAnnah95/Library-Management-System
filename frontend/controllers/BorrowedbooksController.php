<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Borrowedbooks;
use frontend\models\BorrowedbooksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BorrowedbooksController implements the CRUD actions for Borrowedbooks model.
 */
class BorrowedbooksController extends Controller
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
     * Lists all Borrowedbooks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BorrowedbooksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Borrowedbooks model.
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
     * Creates a new Borrowedbooks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Borrowedbooks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($this->bookUpdate($model->bookId)){
            return $this->redirect(['index']);

            }
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }
    public function bookUpdate($bookId){
        $command = \Yii::$app->db->createCommand('UPDATE books SET status=1 WHERE bookId='.$bookId);
        $command->execute();
        return true;
    }
    public function actionReturnbook($id){
        
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->updateAfterDelete($model->bookId);
            return $this->redirect(['index']);
        }
        
        return $this->renderAjax('returnbook',[
            'model'=>$model,
        ]);
    }

    /**
     * Updates an existing Borrowedbooks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bbId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Borrowedbooks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $bookId = BorrowedBooks::find()->where(['bbId'=>$id])->one();
        $this->findModel($id)->delete();
        $this->updateAfterDelete($bookId->bookId);
        return $this->redirect(['index']);
    }

    public function updateAfterDelete($bookId){
        $command = \Yii::$app->db->createCommand('UPDATE books SET status=0 WHERE bookId='.$bookId);
        $command->execute();
        return true;
    }

    /**
     * Finds the Borrowedbooks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Borrowedbooks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Borrowedbooks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
