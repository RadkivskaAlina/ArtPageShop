<?php

namespace app\models;

use Yii;
use app\helpers\StatusHelper;

class Block extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'block';
    }

    public function rules()
    {
        return [
            [['content'], 'string'],
            [['status'], 'integer'],
            [['name', 'image'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'content' => 'Content',
            'status' => 'Status',
            'image' => 'Image',
        ];
    }

    public static function getValue($name){
        $result = self::find()->where(['status' => StatusHelper::$active])
            ->andWhere(['name' => $name])->one();
        if($result !== null){
            return $result->content;
        }
    } 
}
