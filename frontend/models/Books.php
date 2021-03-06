<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $bookId
 * @property string $bookName
 * @property string $referenceNumber
 * @property string $publisher
 * @property int|null $status Status 0, status 1, status 2
 *
 * @property Bookauthor[] $bookauthors
 * @property Borrowedbooks[] $borrowedbooks
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bookName', 'referenceNumber', 'publisher'], 'required'],
            [['status'], 'integer'],
            [['bookName'], 'string', 'max' => 255],
            [['referenceNumber', 'publisher'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bookId' => 'Book ID',
            'bookName' => 'Book Name',
            'referenceNumber' => 'Reference Number',
            'publisher' => 'Publisher',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Bookauthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookauthors()
    {
        return $this->hasMany(Bookauthor::className(), ['bookId' => 'bookId']);
    }

    /**
     * Gets query for [[Borrowedbooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBorrowedbooks()
    {
        return $this->hasMany(Borrowedbooks::className(), ['bookId' => 'bookId']);
    }
}
