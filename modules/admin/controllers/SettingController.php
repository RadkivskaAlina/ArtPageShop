<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Setting;
use app\models\SettingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class SettingController extends Controller
{
    public function actionIndex()
    {
        $model = new Setting();
        if($post = Yii::$app->request->post('Setting')){
            if(is_array($post)){
                foreach($post as $key=>$item){
                    $name = $key;
                    $value = $item;
                    if($model->findSetting($name)){
                        $result = $model->findSetting($name);
                        $setting = Setting::findOne($result->id);
                        $setting->name = $key;
                        $setting->value = $value;
                        $setting->save(false);
                    }else{
                        $model->name = $key;
                        $model->$value = $value;
                        $model->save(false);
                    }
                }
            }
        }
        return $this->render('index');
    }
}
