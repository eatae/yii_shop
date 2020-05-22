<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\admin\widgets\OrdersWidget;

/* @var $this yii\web\View */
/* @var $orders[]  app\modules\admin\models\Order */

//var_dump($orders);


$this->title = 'Заказы';
?>

<!-- begin:article -->
<div class="row" id="show_orders">

    <!-- begin:content -->
    <div class="col-md-12 col-sm-12 content">

        <div class="row">
            <div class="col-md-7">
                <h3>Заказы</h3>
            </div>
        </div>

        <div id="ajax_orders_container">
            <?= OrdersWidget::widget([ 'orders' => $orders ]); ?>
        </div>

    </div>
    <!-- end:content -->
</div>
<!-- end:article -->
