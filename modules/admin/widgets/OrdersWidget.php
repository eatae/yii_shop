<?php

namespace app\modules\admin\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\models\Order;

/**
 * @property Order[] $orders
 */
class OrdersWidget extends Widget
{
    public $orders;

    public function run()
    {
        //if (!$this->orders) { return 'Заказов нет'; }
        ?>

        <div class="row">
            <div class="col-md-12">

                <table class="table table-bordered table-striped">
                    <thead>
                    <tr class="success">
                        <th>№</th>
                        <th>Покупатель</th>
                        <th>email</th>
                        <th>Создан</th>
                        <th>Обновлен</th>
                        <th>Статус</th>
                        <th>Кол-во</th>
                        <th>Сумма</th>
                    </tr>
                    </thead>
                    <tbody>

                    <? foreach ($this->orders as $order) { ?>
                        <tr data-order_id='<?= $order->id ?>'>
                            <!-- id -->
                            <td><span><?= $order->id ?></span></td>
                            <!-- Customer -->
                            <td><span><?= $order->customer->first_name . ' ' . $order->customer->last_name ?></span></td>
                            <!-- email -->
                            <td><span><?= $order->customer->email[0] ?></span></td>
                            <!-- created_at -->
                            <td><span><?= $order->created_at ?></span></td>
                            <!-- updated_at -->
                            <td><span><?= $order->updated_at ?></span></td>
                            <!-- status -->
                            <td><span><?= $this->showStatus($order->status) ?></span></td>
                            <!-- qty -->
                            <td><span><?= $order->qty ?></span></td>
                            <!-- sum -->
                            <td><span class="product_price"><?= sprintf( "%.2f",($order->sum) ) ?></span> p</td>
                        </tr>
                    <? } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?
    }



    public function showStatus($status) {
        if ($status == '1') {
            return '<b class="text-success">Завершен</b>';
        } else {
            return '<b class="text-warning">Активен</b>';
        }
    }
}