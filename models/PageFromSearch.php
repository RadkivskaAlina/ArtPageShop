<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Page;

class PageFromSearch extends Product
{
    public function rules()
    {
        return [
            [['price', 'minprice', 'maxprice'], 'integer'],
            [['sort_option'], 'string'],
            [['manufacture_id'], 'safe']
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params, $category_id = null)
    {
        $query = Page::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        $this->load($params);
        return $dataProvider;
    }
}
?>