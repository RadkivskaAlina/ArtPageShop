<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/_main.css',
        'css/error.css',
        'css/index.css',
        'css/product-category.css',
        'css/item.css',
        'css/cart.css',
    ];
    public $js = [
    ];
}
