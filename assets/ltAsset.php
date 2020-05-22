<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;


class ltAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/html5shiv.js',
        'js/respond.min.js',
    ];

    public $jsOptions = [
        /* условие */
        'condition' => 'lte IE9',
        /* расположение в head */
        'position' => View::POS_HEAD,
    ];
}
