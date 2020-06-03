<?php

namespace app\models;

use Yii;
use app\helpers\StatusHelper;

class Payment extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'payment';
    }

    public function rules()
    {
        return [
            [['value'], 'string'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
            'status' => 'Status',
        ];
    }

    public static function findActive(){
        return self::find()->where(['status' => StatusHelper::$active])->all();
    }
}
