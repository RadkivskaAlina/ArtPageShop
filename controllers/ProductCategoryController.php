<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\helpers\StatusHelper;
use app\models\ProductCategory;
use app\models\Product;
use app\models\Manufacture;
use app\models\ProductFromSearch;;
use yii\data\ActiveDataProvider;
use yii\web\HttpException;

class ProductCategoryController extends Controller
{
    public function actionView($id){
        $model = $this->findModel($id);
        $this->registerMetaTags($model);
        $searchModel = new ProductFromSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
        $modelCategory = $this->findCategories();
        $manufacture = Manufacture::showActive();
        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'categories' => $modelCategory,
            'manufacture' => $manufacture,
        ]);
    }

    public function findModel($id){
        $model = ProductCategory::find()->where(['id' => $id])
            ->andWhere(['status' => StatusHelper::$active])->one();
        if(!$model){
            throw new HttpException(404, 'Product category not found');
        }
        return $model;
    }

    public function findCategories(){
        $model = ProductCategory::find()->where(['status' => StatusHelper::$active])->all();
        if(!$model){
            throw new HttpException(404, 'Product category not found');
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
}
?>