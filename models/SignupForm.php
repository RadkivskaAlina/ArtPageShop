<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class SignupForm extends Model
{
    public $name;
    public $password;
    public $first_name;
    public $second_name;
    public $email;
    public $phone;
    

    public function rules()
    {
        return [
            [['name','first_name', 'second_name', 'password', 'email', 'phone'], 'required'],
            [['name','first_name', 'second_name', 'password', 'email', 'phone'], 'string'],
            [['name'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => "Ім'я користувача",
            'first_name' => "Ім'я",
            'second_name' => 'Прізвище',
            'phone' => 'Телефон',
            'email' => 'Електрона пошта',
            'password' => 'Пароль',
            'status' => 'Status',
            'role' => 'Role',
            'last_visit' => 'Last Visit',
            'image' => 'Image',
        ];
    }

    public function signup(){
        if($this->validate()){
            $user = new User;
            $user->attributes = $this->attributes;
            return $user->create();
        }
    }
}