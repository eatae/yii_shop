<?php

/* @var $cart ShoppingCart */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yz\shoppingcart\ShoppingCart;



$positions = $cart->positions;

?>
<style>
    .wrap_message {
        min-height: 40px;
        min-width: 280px;
        padding: 14px 0 0 10px;
    }

    .wrap_message .message {
        display: none;
    }

    .wrap_message .message .invalid {
        color: #a94442;
    }
</style>
<!-- begin:article -->
<div class="row" id="cart_show">

    <!-- begin:content -->
    <div class="col-md-12 col-sm-12 content">

        <div class="row" id="cart_nav">
            <div class="col-md-7">
                <h3>Корзина</h3>
            </div>
<!--            <div class="col-md-5">-->
<!--                <ul class="nav nav-pills pull-right">-->
<!--                    <li class="active"><a href="#">Корзина</a></li>-->
<!--                    <li><a href="#">Данные покупателя</a></li>-->
<!--                </ul>-->
<!--            </div>-->
        </div>

        <div class="row">
            <div class="col-md-12">

                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Фото</th>
                        <th>Описание</th>
                        <th>Количество</th>
                        <th>Цена</th>
                        <th>Сумма</th>
                    </tr>
                    </thead>
                    <tbody id="container_cart_show">

                    <? foreach ($positions as $position) { ?>
                        <tr data-product_id='<?= $position->id ?>'>
                            <td><img src="<?= Url::to('@prodImg/'.$position->img); ?>" class="img-cart" /></td>
                            <td><strong><?= $position->description; ?></strong><!--<p>Размер</p>--></td>
                            <td>
                                <!-- Form
                                ------------->
                                <? $form = ActiveForm::begin(['options' => ['class'=>'form-inline'], 'validateOnSubmit' => false]); ?>
<!--                                <form action="/cart/show" class="form-inline">-->
                                    <div class="form-group">
                                        <input class="form-control" type="text" value="<?= $position->quantity; ?>" name="ChangeCartPositionForm[quantity]" autocomplete="off" />

                                        <input type="hidden" value="<?= $position->id; ?>" name="ChangeCartPositionForm[product_id]" />

                                        <button rel="tooltip" title="Сохранить" class="btn btn-default" name="action" value="update">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button rel="tooltip" title="Удалить" class="btn btn-primary" name="action" value="delete">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                        <!--                                    <a href="#" class="btn btn-primary" rel="tooltip" title="Delete"><i class="fa fa-trash-o"></i></a>-->

                                        <div class="wrap_message">
                                            <div class="message">

                                            </div>
                                        </div>
                                    </div>
<!--                                </form>-->


                                <? ActiveForm::end() ?>
                            </td>
                            <td><span class="product_price"><?= sprintf( "%.2f",($position->price) ) ?></span> p</td>
                            <td><span class="product_cost"><?= sprintf( "%.2f",($position->cost) ) ?></span> p</td>
                        </tr>
                    <? } ?>



                        <tr>
                            <td colspan="6">&nbsp;</td>
                        </tr>
    <!--                    <tr>-->
    <!--                        <td colspan="4" class="text-right">Total Product</td>-->
    <!--                        <td>$86.00</td>-->
    <!--                    </tr>-->
    <!--                    <tr>-->
    <!--                        <td colspan="4" class="text-right">Доставка</td>-->
    <!--                        <td>$2.00</td>-->
    <!--                    </tr>-->
                        <tr>
                            <td colspan="4" class="text-right"><strong>Общее кол-во</strong></td>
                            <td id="inTableTotalCount"><?= $cart->count; ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right"><strong>Общая сумма</strong></td>
                            <td><span class="cart-cost"><?= sprintf( "%.2f",($cart->cost) ) ?></span> p</td>
                        </tr>
                    </tbody>
                </table>

                <a href="categories.html" class="btn btn-default">Продолжить покупки</a>
                <a href="<?= Url::to('/order/customer-form') ?>" class="btn btn-primary pull-right <? if ($cart->isEmpty) { echo 'disabled'; } ?>"  >Далее</a>
            </div>
        </div>
    </div>
    <!-- end:content -->
</div>
<!-- end:article -->