<?php

namespace app\models;

use Yii;

class Setting extends \yii\db\ActiveRecord
{ static function tableName()
    {
        return 'setting';
    }

    public function rules()
    {
        return [
            [['value'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
        ];
    }

    public function findSetting($name){
        $result = self::find()->where(['name' => $name])->one();
        if(isset($result->id) !== null){
            return $result;
        }
        return false;
    }
}