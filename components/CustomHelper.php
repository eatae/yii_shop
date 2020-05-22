<?php

namespace app\components;

use Yii;

class CustomHelper
{
    /**
     * @return string
     *
     * referrer сам всё обрабатывает, метод не нужен.
     */
    /*public static function backUrl()
    {
        $pos = strpos(Yii::$app->request->referrer, Yii::$app->request->hostName);
        return ($pos) ? Yii::$app->request->referrer : Yii::$app->homeUrl;
    }*/
}