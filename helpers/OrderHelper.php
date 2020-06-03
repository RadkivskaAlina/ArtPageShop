<?php
namespace app\helpers;

use Yii;

class OrderHelper{
    public static $isNew = 1;
    public static $payment = 2;
    public static $closed = 3;
    public static $inWork = 4;
    
    public static function show(){
        return [
            self::$isNew => 'New',
            self::$payment => 'Payment',
            self::$closed => 'Closed',
            self::$inWork => 'In Work'
        ];
    }
}
?>