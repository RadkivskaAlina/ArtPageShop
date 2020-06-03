<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\helpers\StatusHelper;
use app\models\Product;
use app\models\ProductCategory;
use app\models\Cart;
use yii\web\HttpException;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class ProductController extends Controller
{
    public function actionView($id){
        $model = $this->findModel($id);
        $this->registerMetaTags($model);
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->orderBy('id DESC')->limit(3),
            'pagination' => false,
        ]);
        $categories = $this->findCategories();
        return $this->render('view', [
            'model' => $model,
            'data_provider' => $dataProvider,
            'categories' => $categories,
        ]);
    }

    public function findModel($id){
        $model = Product::find()->where(['id' => $id])
            ->andWhere(['status' => StatusHelper::$active])->one();
        if(!$model){
            throw new HttpException(404, 'Product not found');
        }
        return $model;
    }

    public function registerMetaTags($model)
    {
        if($model){
            $view = Yii::$app->view;
            $view->title = $model->meta_title;
            $view->registerMetaTag(['name' => 'description', 'content' => $model->meta_description]);
        }
    }

    public function findCategories(){
        $model = ProductCategory::find()->where(['status' => StatusHelper::$active])->all();
        if(!$model){
            throw new HttpException(404, 'Product category not found');
        }
        return $model;
    }
}
?>