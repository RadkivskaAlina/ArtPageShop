<?php

namespace app\models;

use Yii;
use app\helpers\StatusHelper;

class Delivery extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'delivery';
    }

    public function rules()
    {
        return [
            [['value'], 'string'],
            [['price', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
            'price' => 'Price',
            'status' => 'Status',
        ];
    }

    public static function findActive(){
        return self::find()->where(['status' => StatusHelper::$active])->all();
    }
}
