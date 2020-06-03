<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Page;
use app\models\PageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ImageUpload;
use app\models\UploadForm;
use yii\web\UploadedFile;

class PageController extends Controller
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
        $searchModel = new PageSearch();
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
        $model = new Page();

        if ($model->load(Yii::$app->request->post())) {
            $model->image = UploadedFile::getInstance($model, 'image');
            $model->image->saveAs('uploads/'.$model->image->baseName .'.'.$model->image->extension);
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
        $page = $this->findModel($id);

        if($page->load(Yii::$app->request->post()))
        {
            if (Yii::$app->request->isPost)
            {
                $file = UploadedFile::getInstance($page, 'image');

                if($page->saveImage($model->uploadFile($file, $page->image))){
                    return $this->redirect(['view', 'id'=>$page->id]);
                }
            }
        }
        return $this->render('update', [
            'model' => $page,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
