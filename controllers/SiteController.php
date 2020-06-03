<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\helpers\StatusHelper;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Product;
use app\models\PageFromSearch;
use app\models\ProductCategory;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new Product;
        $query = Product::find()->orderBy('id DESC')->limit(6);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);

        $modelCategory = $this->findCategories();


        return $this->render('index', [
            'model' => $model, 
            'dataProvider' => $dataProvider,
            'categories' => $modelCategory,
        ]);
    }

    public function actionAbout()
    {
        $model = $this->findModel(1);
        $searchModel = new PageFromSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('about',[
            'dataProvider' => $dataProvider,
            'model' => $model,
            'searchModel' => $searchModel
        ]);
    }

    public function findCategories(){
        $model = ProductCategory::find()->where(['status' => StatusHelper::$active])->all();
        if(!$model){
            throw new HttpException(404, 'Product category not found');
        }
        return $model;
    }

    public function findModel($id){
        $model = ProductCategory::find()->where(['id' => $id])
            ->andWhere(['status' => StatusHelper::$active])->one();
        if(!$model){
            throw new HttpException(404, 'Product category not found');
        }
        return $model;
    }
}
