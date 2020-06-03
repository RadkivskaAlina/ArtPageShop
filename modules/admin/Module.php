<?php

namespace app\modules\admin;

use Yii;
use yii\filters\AccessControl;

class Module extends \yii\base\Module
{
    public $layout = '/admin';
    
    public function behaviors()
    {
        return [
            'access'    =>  [
                'class' =>  AccessControl::className(),
                'denyCallback'  =>  function($rule, $action)
                {
                    throw new \yii\web\NotFoundHttpException();
                },
                'rules' =>  [
                    [
                        'allow' =>  true,
                        'matchCallback' =>  function($rule, $action)
                        {
                            if(isset(Yii::$app->user->identity->role) && Yii::$app->user->identity->role == 1){
                                return true;
                            } 
                        }
                    ]
                ]
            ]
        ];
    }

    public function init()
    {
        parent::init();
    }
}
