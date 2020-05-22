<?php

namespace app\modules\admin\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\models\Order;

/**
 * @property Order[] $orders
 */
class OneOrderWidget extends Widget
{
    public $order;
    public $orderItems;

    public function run()
    {
        //if (!$this->orders) { return 'Заказов нет'; }
        ?>
        <div class="row">
            <div class="col-md-7">
                <h4>Заказ</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <table class="table table-bordered table-striped">
                    <thead>
                    <tr class="success">
                        <th>№</th>
                        <th>Создан</th>
                        <th>Обновлен</th>
                        <th>Статус</th>
                        <th>Кол-во</th>
                        <th>Сумма</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr data-order_id='<?= $this->order->id ?>'>
                            <!-- id -->
                            <td><span><?= $this->order->id ?></span></td>
                            <!-- created_at -->
                            <td><span><?= $this->order->created_at ?></span></td>
                            <!-- updated_at -->
                            <td><span><?= $this->order->updated_at ?></span></td>
                            <!-- status -->
                            <td><span><?= $this->showStatus($this->order->status) ?></span></td>
                            <!-- qty -->
                            <td><span><?= $this->order->qty ?></span></td>
                            <!-- sum -->
                            <td><span class="product_price"><?= sprintf( "%.2f",($this->order->sum) ) ?></span> p</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="row">
            <div class="col-md-7">
                <h4>Товары</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <table class="table table-bordered table-striped">
                    <thead>
                    <tr class="success">
                        <th>Фото</th>
                        <th>Описание</th>
                        <th>Количество</th>
                        <th>Цена</th>
                        <th>Сумма</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($this->orderItems as $item) { ?>

                        <tr data-item_id='<?= $item->id ?>'>
                            <!-- photo -->
                            <td><img src="<?= Url::to('@prodImg/'.$item->product->img); ?>" class="img-cart" /></td>
                            <!-- description -->
                            <td><span><?= $item->product->description ?></span></td>
                            <!-- quantity -->
                            <td><span><?= $item->qty ?></span></td>
                            <!-- status -->
                            <td><span><?= sprintf( "%.2f",($item->price) ) ?></span></td>
                            <!-- qty -->
                            <td><span><?= sprintf( "%.2f",($item->cost) ) ?></span> p</td>
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