<?php

use app\modules\admin\widgets\OrdersWidget;
use app\modules\admin\widgets\OneOrderWidget;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $order  app\modules\admin\models\Order */
/* @var $orderItems  app\modules\admin\models\OrderItems */
?>

<!-- show customer -->
<div class="row">
    <div class="col-md-7">
        <h4>Покупатель</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-12">

        <table class="table table-bordered table-striped">
            <thead>
            <tr class="warning">
                <th>ID</th>
                <th>Email</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Адрес</th>
                <th>Телефон</th>
            </tr>
            </thead>
            <tbody>
                <tr data-order_id='<?= $order->id ?>'>
                    <!-- id -->
                    <td><span><?= $order->customer->id ?></span></td>
                    <!-- email -->
                    <td><span><?= $order->customer->email[0] ?></span></td>
                    <!-- first name -->
                    <td><span><?= $order->customer->first_name ?></span></td>
                    <!-- last name -->
                    <td><span><?= $order->customer->last_name ?></span></td>
                    <!-- address -->
                    <td><span><?= $order->customer->address ?></span></td>
                    <!-- phone -->
                    <td><span><?= $order->customer->phone ?></span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- show order -->
<?= OneOrderWidget::widget([ 'order' => $order, 'orderItems' => $orderItems ]); ?>






















<?php
var_dump($orderItems);

//foreach ($orderItems as $item) {
//    var_dump($item);
//    var_dump($item->product);
//}
?>


