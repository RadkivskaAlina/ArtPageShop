<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

class ProductFromSearch extends Product
{
    public $pageSize = 6;
    public $minprice;
    public $maxprice;
    public $sort_option;
    public $manufacture_id;

    public function rules()
    {
        return [
            [['price', 'minprice', 'maxprice'], 'integer'],
            [['sort_option'], 'string'],
            [['manufacture_id'], 'safe']
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
            'manufacture_id' => 'Виробництво',
            'status' => 'Status',
            'price' => 'Ціна',
            'minprice' => 'Мінімальна ціна',
            'maxprice' => 'Максимальна ціна',
            'sort_option' => 'Сортування',
            'image' => 'Image',
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params, $category_id = null)
    {
        $query = Product::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>[
                'pageSize' =>$this->pageSize,
            ]
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        if($category_id !== null){
            $query->andFilterWhere(['category_id' => $category_id]);
        }
        $post = Yii::$app->request->get('ProductFromSearch');
        if(isset($post['manufacture_id'])){
            $query->andFilterWhere(['manufacture_id' => $this->manufacture_id]);
        }
        if(isset($post['minprice'])){
            $query->andFilterWhere(['>=', 'price', $this->minprice]);            
        }
        if(isset($post['maxprice'])){
            $query->andFilterWhere(['<=', 'price', $this->maxprice]);            
        }
        if(isset($post['sort_option'])){
            $query->orderBy('price '.$post['sort_option']);            
        }
        return $dataProvider;
    }
}
?>