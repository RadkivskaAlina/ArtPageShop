<?php

namespace app\models;

use Yii;
use app\helpers\StatusHelper;

class ProductCategory extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'product_category';
    }

    public function rules()
    {
        return [
            [['meta_description', 'content'], 'string'],
            [['status'], 'integer'],
            [['name', 'meta_title', 'image'], 'string', 'max' => 255],
            [['name', 'meta_title'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'content' => 'Content',
            'status' => 'Status',
            'image' => 'Image',
        ];
    }

    public static function showActive(){
        return self::find()->where(['status' => StatusHelper::$active])->all();
    }
}
