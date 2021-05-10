<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class LeftCartWidget extends Widget
{
    public $cart;

    public function run()
    {
        $positions = $this->cart->getPositions() ?: null;
        $cost = $this->cart->getCost() ?: null;
        ?>
        <div class="widget" id="left_cart">
            <div class="widget-title">
                <h3>Выбрано:</h3>
            </div>
            <ul class="cart list-unstyled" id="items_container">

                <? if ( empty($positions) ) { ?>
                    <div class="row" id="no_positions">
                        <div class="col-sm-7 col-xs-7">Нет товаров</div>
                    </div>
                <? }

                else {
                    foreach ($positions as $product) {
                        ?>
                        <li data-product_id="<?= $product->id ?>">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 product-description">
                                    [<span class="product_count"><?= $product->quantity; ?></span>] <a href="<?= Url::to(['product-detail', 'product_id' => $product->id]); ?>"><?= $product->description; ?></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 text-right product-price">
                                    <div><strong><?= $product->price; ?></strong> <a href="<?= Url::to(['cart/deduct', 'product_id' => $product->id])?>" class="trash_product"><i class="fa fa-trash-o"></i></a></div>
                                </div>
                            </div>
                        </li>
                        <?
                    }
                } ?>

            </ul>
            <ul class="list-unstyled total-price">
                <li>
                    <div class="row">
                        <div class="col-sm-8 col-xs-6">Сумма</div>
                        <div class="col-sm-4 col-xs-6 text-right" id="left_cart_cost"><?= sprintf( "%.2f",($this->cart->cost) ) ?></div>
                    </div>
                </li>
                <!--<li>
                    <div class="row">
                        <div class="col-sm-6 col-xs-6">
                            <a class="btn btn-default" href="cart.html">Корзина</a>
                        </div>
                        <div class="col-sm-6 col-xs-6 text-right">
                            <a class="btn btn-primary" href="login.html">Войти</a>
                        </div>
                    </div>
                </li>-->
            </ul>
        </div>
        <?
    }
}
