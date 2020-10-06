<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "borrowedbooks".
 *
 * @property int $bbId
 * @property int $studentId
 * @property int $bookId
 * @property string $borrowDate
 * @property string $expectedReturn
 * @property string|null $actualReturnDate
 *
 * @property Students $student
 * @property Books $book
 */
class Borrowedbooks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'borrowedbooks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['studentId', 'bookId', 'borrowDate', 'expectedReturn'], 'required'],
            [['studentId', 'bookId'], 'integer'],
            [['borrowDate', 'expectedReturn', 'actualReturnDate'], 'safe'],
            [['studentId'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['studentId' => 'studentId']],
            [['bookId'], 'exist', 'skipOnError' => true, 'targetClass' => Books::className(), 'targetAttribute' => ['bookId' => 'bookId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bbId' => 'Bb ID',
            'studentId' => 'Student ID',
            'bookId' => 'Book ID',
            'borrowDate' => 'Borrow Date',
            'expectedReturn' => 'Expected Return',
            'actualReturnDate' => 'Actual Return Date',
        ];
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Students::className(), ['studentId' => 'studentId']);
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Books::className(), ['bookId' => 'bookId']);
    }
}
