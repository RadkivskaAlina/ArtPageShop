<?php

namespace app\models;

use Yii;
use app\helpers\StatusHelper;

class Product extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'product';
    }

    public function rules()
    {
        return [
            [['meta_description', 'short_content', 'content'], 'string'],
            [['in_stock', 'category_id', 'status', 'manufacture_id'], 'integer'],
            [['name', 'meta_title', 'image'], 'string', 'max' => 255],
            [['name', 'short_content', 'content', 'meta_title', 'price'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'short_content' => 'Short Content',
            'content' => 'Content',
            'in_stock' => 'In Stock',
            'category_id' => 'Category ID',
            'manufacture_id' => 'Manufacture ID',
            'status' => 'Status',
            'price' => 'Price',
            'image' => 'Image',
        ];
    }

    public static function findActive(){
        return self::find()->where(['status' => StatusHelper::$active]);
    }

    public static function findInCategory($category_id){
        return self::find()->where(['status' => StatusHelper::$active])
            ->andwhere(['category_id' =>$category_id]);
    }

    public function getCategory(){
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
    }

    public function getManufacture(){
        return $this->hasOne(Manufacture::className(), ['id' => 'manufacture_id']);
    }

    public function saveImage($filename){
        $this->image = $filename;
        return $this->save(false);
    }

    public static function getProductInformation($id){
        return self::findOne($id);
    }
}
?>