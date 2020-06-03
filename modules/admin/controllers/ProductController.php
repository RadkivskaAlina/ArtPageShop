<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ImageUpload;
use app\models\UploadForm;
use yii\web\UploadedFile;

class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post())) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if(!empty($model->image)){
                $model->image->saveAs('uploads/'.$model->image->baseName .'.'.$model->image->extension);
            }
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = new ImageUpload;
        $product = $this->findModel($id);

        if($product->load(Yii::$app->request->post()))
        {
            if (Yii::$app->request->isPost)
            {
                $file = UploadedFile::getInstance($product, 'image');

                if($product->saveImage($model->uploadFile($file, $product->image))){
                    return $this->redirect(['view', 'id'=>$product->id]);
                }
            }
        }
        return $this->render('update', ['model' => $product]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function setImage($id){
        $model = new ImageUpload;

        if (Yii::$app->request->isPost)
        {
            $product = $this->findModel($id);
            $file = UploadedFile::getInstance($model, 'image');

            if($product->saveImage($model->uploadFile($file, $product->image))){
                return $this->redirect(['view', 'id'=>$product->id]);
            }
        }
        return $this->render('image', ['model' => $model]);
    }
}
