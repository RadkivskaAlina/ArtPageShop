<?php

namespace app\models;

use Yii;

class Page extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'page';
    }

    public function rules()
    {
        return [
            [['meta_description', 'short_content', 'content'], 'string'],
            [['status', 'category_id'], 'integer'],
            [['name', 'meta_title', 'image'], 'string', 'max' => 255],
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
            'status' => 'Status',
            'category_id' => 'Category ID',
            'image' => 'Image',
        ];
    }

    public function saveImage($filename){
        $this->image = $filename;
        return $this->save(false);
    }
}
