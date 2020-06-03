<?php
namespace app\models;

use Yii;
use app\models\Product;

class Cart
{
    public function add($id){
        $id = (int)$id;
        $productInCart = [];
        if(isset($_SESSION['products'])){
            $productInCart = $_SESSION['products'];
        }
        if(array_key_exists($id, $productInCart)){
            $productInCart[$id]++;
        } else {
            $productInCart[$id] = 1;
            }
        $_SESSION['products'] = $productInCart;
        return true;
    }

    public function min($id){
        $id = (int)$id;
        $productInCart = [];
        if(isset($_SESSION['products'])){
            $productInCart = $_SESSION['products'];
        }
        if(array_key_exists($id, $productInCart)){
            if($productInCart[$id] >= 2){
                $productInCart[$id]--;

            } else {
                unset($productInCart[$id]);
            }
        } 
        $_SESSION['products'] = $productInCart;
        return true;
    }

    public static function countProducts(){
        if(isset($_SESSION['products'])){
            if(is_array($_SESSION['products'])){            
                return count($_SESSION['products']);
            }
        }
        return 0;
    }

    public function products(){
        if(isset($_SESSION['products'])){
            return $_SESSION['products'];
        }
        return false;
    }

    public function remove($id){
        $id = (int)$id;
        $productInCart = [];
        if(isset($_SESSION['products'])){
            $productInCart = $_SESSION['products'];
            unset($productInCart[$id]);
        }
        $_SESSION['products'] = $productInCart;
        return true;
    }

    public function clear(){
        if(isset($_SESSION['products'])){
            unset($_SESSION['products']);
            return true;
        }
        return false;
    }
    
    public function sum(){
        $products = $this->products();
        $sum = 0;
        if(is_array($products)){
            foreach($products as $key => $product_count){
                $product_info = Product::getProductInformation($key);
                if(isset($product_info->price)){
                    $sum += $product_info->price * $product_count;
                }
            }
        }
        return $sum;
    }
}
?>