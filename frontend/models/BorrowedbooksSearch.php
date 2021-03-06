<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Borrowedbooks;
use frontend\models\Students;
use Yii;

/**
 * BorrowedbooksSearch represents the model behind the search form of `frontend\models\Borrowedbooks`.
 */
class BorrowedbooksSearch extends Borrowedbooks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bbId', 'studentId', 'bookId'], 'integer'],
            [['borrowDate', 'expectedReturn', 'actualReturnDate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        if (Yii::$app->user->can('student')){
            $studentId = Students::find()->where(['userId'=>Yii::$app->user->id])->One();
        $query = Borrowedbooks::find()->where(['actualReturnDate'=>NULL])->andWhere(['studentId'=>$studentId->studentId]);
        }

        if (Yii::$app->user->can('librarian')){
            
        $query = Borrowedbooks::find()->where(['actualReturnDate'=>NULL]);
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'bbId' => $this->bbId,
            'studentId' => $this->studentId,
            'bookId' => $this->bookId,
            'borrowDate' => $this->borrowDate,
            'expectedReturn' => $this->expectedReturn,
            'actualReturnDate' => $this->actualReturnDate,           
        ]);

        return $dataProvider;
    }
}
