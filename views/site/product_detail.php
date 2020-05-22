<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\widgets\LeftCartWidget;

//var_dump($product);
//var_dump($category);

//var_dump($cart);

?>
<!-- begin:article -->
<div class="row">
    <!-- begin:sidebar -->
    <div class="col-md-3 col-sm-4 sidebar">
        <div class="row">
            <div class="col-md-12">

                <!-- break -->
                <div class="widget">
                    <div class="widget-title">
                        <h3>Payment Confirmation</h3>
                    </div>
                    <p>Already make a payment ? please confirm your payment by filling <a href="confirm.html">this form</a></p>
                </div>

                <!-- left cart -->
                <?= LeftCartWidget::widget(['cart'=>$cart]); ?>

            </div>
        </div>
    </div>
    <!-- end:sidebar -->

    <!-- begin:content -->
    <div class="col-md-9 col-sm-8 content">

        <!-- Breadcrumbs -->
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <!-- Back -->
                    <li id="back_breadcrumb"><a href="javascript:history.back()"><span class="glyphicon glyphicon-chevron-left"></span>назад</a></li>
                    <li><?= Html::a($parent_category->description, 'category?category_id='. $parent_category->id); ?></li>
                    <li><?= Html::a($child_category->description, 'category?category_id='. $child_category->id); ?></li>
                    <li class="active"><?= $product->description; ?></li>
                    </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="heading-title">
                    <h2><span><?= $product->description; ?></span> <span class="text-yellow"></span></h2>
                </div>
                <div class="row">

                    <!-- begin:product-IMAGE-slider -->
                    <div class="col-md-6 col-sm-6">
                        <div id="product-single" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="product-single">
                                        <img src="<?= Url::to('@prodImg/'.$product->img) ?>" class="img-responsive">
                                    </div>
                                </div>
<!--                                <div class="item">-->
<!--                                    <div class="product-single">-->
<!--                                        <img src="img/product11.jpg" class="img-responsive">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="item">-->
<!--                                    <div class="product-single">-->
<!--                                        <img src="img/product12.jpg" class="img-responsive">-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>

                            <a class="left carousel-control" href="#product-single" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right carousel-control" href="#product-single" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- end:product-IMAGE-slider -->


                    <!-- begin:product-spesification -->
                    <div class="col-md-6 col-sm-6">
                        <div class="single-desc">
                            <form>
                      <span class="visible-xs">
                          <strong>Blackbox / AF0012 / In Stock</strong>
                      </span>

                                <table>
                                    <tbody>
                                    <tr class="hidden-xs">
                                        <td><strong>Brand</strong></td>
                                        <td>:</td>
                                        <td>Blackbox</td>
                                    </tr>
                                    <tr class="hidden-xs">
                                        <td><strong>Product Code</strong></td>
                                        <td>:</td>
                                        <td>AF0012</td>
                                    </tr>
                                    <tr class="hidden-xs">
                                        <td><strong>Availability</strong></td>
                                        <td>:</td>
                                        <td>In Stock</td>
                                    </tr>
                                    <tr>
                                        <!-- Price -->
                                        <td colspan="3">
<!--                                            <span class="price-old">--><?//= sprintf( "%.2f",($product->price * 1.20) ) ?><!-- руб</span>-->
                                            <span class="price"><?= $product->price ?> руб</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Color</strong></td>
                                        <td>:</td>
                                        <td>
                                            <select class="form-control">
                                                <option>Black</option>
                                                <option>Green</option>
                                                <option>Blue</option>
                                                <option>Yellow</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Size</strong></td>
                                        <td>:</td>
                                        <td>
                                            <select class="form-control">
                                                <option>XS</option>
                                                <option>S</option>
                                                <option>M</option>
                                                <option>L</option>
                                                <option>XL</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr id="add_quantity">
                                        <td><strong>Количество</strong></td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" class="form-control" value="1">
                                        </td>
                                    </tr>
                                    <tr id="add_button">
                                        <!-- Add to cart -->
                                        <td colspan="3">
                                            <a href="<?= Url::to(['cart/add', 'product_id' => $product->id])?>"
                                               data-product_id="<?= $product->id; ?>" class="btn btn-sm btn-success">Добавить</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <!-- end:product-spesification -->
                </div>
                <!-- break -->
                <!-- begin:product-detail -->
                <div class="row">
                    <div class="col-md-12 content-detail">
                        <ul id="myTab" class="nav nav-tabs">
                            <li class="active"><a href="#desc" data-toggle="tab">Description</a></li>
                            <li class=""><a href="#care" data-toggle="tab">Care</a></li>
                            <li class=""><a href="#size" data-toggle="tab">Sizing</a></li>
                        </ul>


                    </div>
                </div>
                <!-- end:product-detail -->


            </div>
        </div>
    </div>
    <!-- end:content -->
</div>
<!-- end:article -->