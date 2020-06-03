<?php
namespace app\helpers;

class RoleHelper{
    public static $admin = 1;
    public static $user = 0;

    public static function show(){
        return [
            self::$admin => 'Admin',
            self::$user => 'User'
        ];
    }
}
?>