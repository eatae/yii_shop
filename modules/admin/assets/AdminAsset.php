<?php

namespace app\modules\admin\assets;

use yii\web\AssetBundle;


class AdminAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/admin/assets';

    public $css = [
        'css/admin.css'
    ];

    public $js = [
        'js/admin.js'
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}
