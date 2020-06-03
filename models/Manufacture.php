<?php

namespace app\models;

use Yii;
use app\helpers\StatusHelper;

class Manufacture extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'manufacture';
    }

    public function rules()
    {
        return [
            [['status', 'pos'], 'integer'],
            [['name', 'image'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
            'status' => 'Status',
            'pos' => 'Pos',
        ];
    }

    public static function showActive(){
        return self::find()->where(['status' => StatusHelper::$active])
            ->orderBy('id DESC')->all();
    }
}
