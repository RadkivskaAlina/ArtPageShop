<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['status', 'role', 'last_visit'], 'integer'],
            [['name', 'phone', 'email', 'password', 'image', 'first_name', 'second_name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'password' => 'Password',
            'status' => 'Status',
            'role' => 'Role',
            'first_name' => 'First Name',
            'second_name' => 'Second Name',
            'last_visit' => 'Last Visit',
            'image' => 'Image',
        ];
    }

    public static function findIdentity($id)
    {
        return User::findOne($id);
    }
    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public static function findByUsername($username){
        return User::find()->where(['name' => $username])->one();
    }

    public function validatePassword($password){
        if($this->password == $password){
            return true;
        } else {
            return false;
        }
    } 

    public function create(){
        return $this->save(false);
    }
}