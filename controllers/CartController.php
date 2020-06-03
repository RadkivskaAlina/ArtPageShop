<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\helpers\StatusHelper;
use app\models\Checkout;
use app\models\Delivery;
use app\models\Payment;
use app\models\Product;
use app\models\Cart;
use yii\helpers\Url;

class CartController extends Controller
{
    public function actionIndex(){
        $cart = new Cart;
        $products = null;
        $productsInCart = null;
        $productsCart = null;
        if($cart->products()){
            $productsInCart = $cart->products();
            $productsCart = $productsInCart;
            $productsInCart = implode(',', array_keys($productsInCart));
            $products = Product::find()->where('id IN ('.$productsInCart.')')->all();
        }
        return $this->render('index', ['products' => $products, 'productsCart' => $productsCart]);
    }

    public function actionCheckout(){
        $model = new Checkout;
        $cart = new Cart;
        $payment_list = Payment::findActive();
        $delivery_list = Delivery::findActive();
        $products = null;
        $productsInCart = null;
        if($cart->products()){
            $productsInCart = $cart->products();
            $products = json_encode($productsInCart);
        }
        if($model->load(Yii::$app->request->post())){
            if(is_array($productsInCart)){
                $model->products = $products;
                $model->count = count($productsInCart);
                $model->sum = $cart->sum();
                $model->date_create = time();
                $model->save(false);
                $cart->clear();
                return $this->redirect(Url::to(['/cart/success/'.$model->id]));
            } else {
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->render('checkout', [
            'model' => $model, 
            'delivery_list' => $delivery_list, 
            'payment_list' => $payment_list,
        ]);
    }

    public function actionSuccess($id){
        $result = Checkout::findOne($id);
        if($result !== null){
            return $this->render('success', ['id' => $id]);
        } else {
            return $this->render('not-success', ['id' => $id]);
        }
    }

    public function actionAdd($id){
        $cart = new Cart;
        if($cart->add($id)){
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->redirect(Url::to(['site/index']));
    }

    public function actionClear(){
        $cart = new Cart;
        $cart->clear();
        return $this->redirect(Url::to(['/cart/index']));
    }

    public function actionRemove($id){
        $cart = new Cart;
        if($cart->remove($id)){
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->redirect(Url::to(['cart/index']));
    }

    public function actionMin($id){
        $cart = new Cart;
        if($cart->min($id)){
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->redirect(Url::to(['cart/index']));
    }
}
?>