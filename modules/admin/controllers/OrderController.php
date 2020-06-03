<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Checkout;
use app\models\Cart;
use app\models\Product;
use app\models\CheckoutSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class OrderController extends Controller
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
        $searchModel = new CheckoutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $cart = new Cart;
        $products = null;
        $productsInCart = null;
        $productsCart = null;
        $cartProducts = json_decode($model->products, true);
        if($cartProducts){
            $productsInCart = $cartProducts;
            $productsCart = $productsInCart;
            $productsInCart = implode(',', array_keys($productsInCart));
            $products = Product::find()->where('id IN ('.$productsInCart.')')->all();
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'products' => $products,
            'productsCart' => $productsCart
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cart = new Cart;
        $products = null;
        $productsInCart = null;
        $productsCart = null;
        $cartProducts = json_decode($model->products, true);
        if($cartProducts){
            $productsInCart = $cartProducts;
            $productsCart = $productsInCart;
            $productsInCart = implode(',', array_keys($productsInCart));
            $products = Product::find()->where('id IN ('.$productsInCart.')')->all();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'products' => $products,
            'productsCart' => $productsCart
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Checkout::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
