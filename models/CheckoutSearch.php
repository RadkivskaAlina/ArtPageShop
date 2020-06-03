<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Checkout;

class CheckoutSearch extends Checkout
{
    public function rules()
    {
        return [
            [['id', 'delivery_id', 'payment_id', 'sum', 'count', 'status', 'date_create', 'date_update'], 'integer'],
            [['name', 'surname', 'phone', 'email', 'products'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Checkout::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'delivery_id' => $this->delivery_id,
            'payment_id' => $this->payment_id,
            'sum' => $this->sum,
            'count' => $this->count,
            'status' => $this->status,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'products', $this->products]);

        return $dataProvider;
    }
}
