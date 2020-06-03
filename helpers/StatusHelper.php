<?php
namespace app\helpers;

class StatusHelper{
    public static $active = 1;
    public static $draft = 0;

    public static function show(){
        return [
            self::$active => 'Active',
            self::$draft => 'Draft'
        ];
    }
}
?>