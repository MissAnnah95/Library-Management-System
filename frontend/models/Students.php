<?php

namespace frontend\models;

use Yii;
use common\models\User;


/**
 * This is the model class for table "students".
 *
 * @property int $studentId
 * @property int $userId
 * @property string $fullName
 * @property int $idNumber
 * @property string $regNumber
 *
 * @property Borrowedbooks[] $borrowedbooks
 * @property User $user
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'fullName', 'idNumber', 'regNumber'], 'required'],
            [['userId', 'idNumber'], 'integer'],
            [['fullName'], 'string', 'max' => 255],
            [['regNumber'], 'string', 'max' => 50],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'studentId' => 'Student ID',
            'userId' => 'User ID',
            'fullName' => 'Full Name',
            'idNumber' => 'Id Number',
            'regNumber' => 'Reg Number',
        ];
    }

    /**
     * Gets query for [[Borrowedbooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBorrowedbooks()
    {
        return $this->hasMany(Borrowedbooks::className(), ['studentId' => 'studentId']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
