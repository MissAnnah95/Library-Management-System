<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property int $authorId
 * @property int $authorName
 *
 * @property Bookauthor $bookauthor
 */
class Authors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['authorName'], 'required'],
            [['authorName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'authorId' => 'Author ID',
            'authorName' => 'Author Name',
        ];
    }

    /**
     * Gets query for [[Bookauthor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookauthor()
    {
        return $this->hasOne(Bookauthor::className(), ['authorId' => 'authorId']);
    }
}
