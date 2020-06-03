<?php

namespace app\models;

use Yii;

class Checkout extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'order';
    }

    public function rules()
    {
        return [
            [['delivery_id', 'payment_id', 'sum', 'count', 'status', 'date_create', 'date_update'], 'integer'],
            [['products'], 'string'],
            [['name', 'surname', 'phone',], 'string', 'max' => 255],
            [['email'], 'email'],
            [['name', 'surname', 'phone', 'email', 'delivery_id', 'payment_id'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => "Ім'я",
            'surname' => 'Прізвище',
            'phone' => 'Номер телефону',
            'email' => 'Електрона пошта',
            'delivery_id' => 'Пошта',
            'payment_id' => 'Спосіб оплати',
            'sum' => 'Sum',
            'count' => 'Count',
            'products' => 'Products',
            'status' => 'Status',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
        ];
    }
    public function getId()
    {
        return $this->id;
    }
}
