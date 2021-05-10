<?php

use yii\helpers\Url;
/* @var $this yii\web\View */



$this->title = 'Главная';


//var_dump($hit_products);
?>
<!-- begin:home-slider -->
<div id="home-slider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#home-slider" data-slide-to="0" class="active"></li>
        <li data-target="#home-slider" data-slide-to="1" class=""></li>
        <li data-target="#home-slider" data-slide-to="2" class=""></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <img src="<?= Url::to('@prodImg/slider1.png'); ?>" alt="clotheshop">
            <div class="carousel-caption hidden-xs">
                <h3>First slide label</h3>
                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            </div>
        </div>
        <div class="item">
            <img src="<?= Url::to('@prodImg/slider2.png'); ?>" alt="clotheshop">
            <div class="carousel-caption hidden-xs">
                <h3>Second slide label</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
        <div class="item">
            <img src="<?= Url::to('@prodImg/slider3.png'); ?>" alt="clotheshop">
            <div class="carousel-caption hidden-xs">
                <h3>Third slide label</h3>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#home-slider" data-slide="prev">
        <i class="fa fa-angle-left"></i>
    </a>
    <a class="right carousel-control" href="#home-slider" data-slide="next">
        <i class="fa fa-angle-right"></i>
    </a>
</div>
<!-- end:home-slider -->


<!-- begin:best-seller -->
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h2>Бестселлеры <small>наиболее популярные товары</small></h2>
        </div>
    </div>
</div>

<div class="row product-container">
    <? $cnt = 0 ?>
    <? foreach ($hit_products as $product) {
        $cnt++; ?>
        <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="thumbnail product-item">
                <a href="<?= Url::to( 'site/product-detail?product_id='.$product->id ) ?>">
                    <img alt="" src="<?= Url::to( '@prodImg/'.$product->img ) ?>"  height="304">
                </a>
                <div class="caption">
                    <h5><?= $product->description; ?></h5>
                    <p><?= $product->price; ?> <small>руб</small></p>
                    <p>В наличии</p>
                </div>
                <? if ($product->new) { ?>
                    <div class="product-item-badge">New</div>
                <? }
                elseif ($product->sale) { ?>
                    <div class="product-item-badge badge-sale">Sale</div>
                <? } ?>
            </div>
        </div>
    <? if ($cnt >= 4) {
        break;
    }
    } // end foreach ?>

<!--    <div class="col-md-3 col-sm-3 col-xs-6">-->
<!--        <div class="thumbnail product-item">-->
<!--            <a href="product_detail.html"><img alt="" src="img/product2.jpg"></a>-->
<!--            <div class="caption">-->
<!--                <h5>T-shirt</h5>-->
<!--                <p class="product-item-price">$54.00</p>-->
<!--                <p>Available</p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-3 col-sm-3 col-xs-6">-->
<!--        <div class="thumbnail product-item">-->
<!--            <a href="product_detail.html"><img alt="" src="img/product3.jpg"></a>-->
<!--            <div class="caption">-->
<!--                <h5>Casual Rock Pants</h5>-->
<!--                <p><del>$54.00</del> $32.00</p>-->
<!--                <p>Available</p>-->
<!--            </div>-->
<!--            <div class="product-item-badge badge-sale">Sale</div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-3 col-sm-3 col-xs-6">-->
<!--        <div class="thumbnail product-item">-->
<!--            <a href="product_detail.html"><img alt="" src="img/product4.jpg"></a>-->
<!--            <div class="caption">-->
<!--                <h5>Casual Rock T-Shirt</h5>-->
<!--                <p>$54.00</p>-->
<!--                <p>Available</p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</div>
<!-- end:best-seller -->


<!-- begin:new-arrival -->
<div class="row">
    <dov class="col-md-12">
        <div class="page-header">
            <h2>Новое <small>свежие поступления</small></h2>
        </div>
    </dov>
</div>

<div class="row product-container">
    <? $cnt = 0 ?>
    <? foreach ($new_products as $product) {
        $cnt++; ?>
        <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="thumbnail product-item">
                <a href="<?= Url::to( 'site/product-detail?product_id='.$product->id ) ?>">
                    <img alt="" src="<?= Url::to( '@prodImg/'.$product->img ) ?>">
                </a>
                <div class="caption">
                    <h5><?= $product->description; ?></h5>
                    <p><?= $product->price; ?> <small>руб</small></p>
                    <p>В наличии</p>
                </div>
                <div class="product-item-badge">New</div>
            </div>
        </div>
        <?  if ($cnt >= 4) { break; }
    } // end foreach ?>

<!--    <div class="col-md-3 col-sm-3 col-xs-6">-->
<!--        <div class="thumbnail product-item">-->
<!--            <a href="product_detail.html"><img alt="" src="img/product1.jpg"></a>-->
<!--            <div class="caption">-->
<!--                <h5>Pants</h5>-->
<!--                <p>$54.00</p>-->
<!--                <p>Available</p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-3 col-sm-3 col-xs-6">-->
<!--        <div class="thumbnail product-item">-->
<!--            <a href="product_detail.html"><img alt="" src="img/product2.jpg"></a>-->
<!--            <div class="caption">-->
<!--                <h5>Pants</h5>-->
<!--                <p>$54.00</p>-->
<!--                <p>Available</p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-3 col-sm-3 col-xs-6">-->
<!--        <div class="thumbnail product-item">-->
<!--            <a href="product_detail.html"><img alt="" src="img/product3.jpg"></a>-->
<!--            <div class="caption">-->
<!--                <h5>Pants</h5>-->
<!--                <p>$54.00</p>-->
<!--                <p>Available</p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-3 col-sm-3 col-xs-6">-->
<!--        <div class="thumbnail product-item">-->
<!--            <a href="product_detail.html"><img alt="" src="img/product4.jpg"></a>-->
<!--            <div class="caption">-->
<!--                <h5>Pants</h5>-->
<!--                <p>$54.00</p>-->
<!--                <p>Available</p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</div>
<!-- end:new-arrival -->


<!-- begin:random-product -->
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h2>Разное <small>другие категории</small></h2>
        </div>
    </div>
</div>


<div class="row product-container">

    <? $cnt = 0 ?>
    <? foreach ($rand_products as $product) {
        $cnt++; ?>
        <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="thumbnail product-item">
                <a href="<?= Url::to( 'site/product-detail?product_id='.$product->id ) ?>">
                    <img alt="" src="<?= Url::to( '@prodImg/'.$product->img ) ?>">
                </a>
                <div class="caption">
                    <h5><?= $product->description; ?></h5>
                    <p><?= $product->price; ?> <small>руб</small></p>
                    <p>В наличии</p>
                </div>
                <? if ($product->new) { ?>
                    <div class="product-item-badge">New</div>
                <? }
                elseif ($product->sale) { ?>
                    <div class="product-item-badge badge-sale">Sale</div>
                <? } ?>
            </div>
        </div>
        <?  if ($cnt >= 4) { break; }
    } // end foreach ?>
<!--    <div class="col-md-3 col-sm-3 col-xs-6">-->
<!--        <div class="thumbnail product-item">-->
<!--            <a href="product_detail.html"><img alt="" src="img/product1.jpg"></a>-->
<!--            <div class="caption">-->
<!--                <h5>Pants</h5>-->
<!--                <p>$54.00</p>-->
<!--                <p>Available</p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-3 col-sm-3 col-xs-6">-->
<!--        <div class="thumbnail product-item">-->
<!--            <a href="product_detail.html"><img alt="" src="img/product2.jpg"></a>-->
<!--            <div class="caption">-->
<!--                <h5>Pants</h5>-->
<!--                <p>$54.00</p>-->
<!--                <p>Available</p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-3 col-sm-3 col-xs-6">-->
<!--        <div class="thumbnail product-item">-->
<!--            <a href="product_detail.html"><img alt="" src="img/product3.jpg"></a>-->
<!--            <div class="caption">-->
<!--                <h5>Pants</h5>-->
<!--                <p>$54.00</p>-->
<!--                <p>Available</p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-3 col-sm-3 col-xs-6">-->
<!--        <div class="thumbnail product-item">-->
<!--            <a href="product_detail.html"><img alt="" src="img/product4.jpg"></a>-->
<!--            <div class="caption">-->
<!--                <h5>Pants</h5>-->
<!--                <p>$54.00</p>-->
<!--                <p>Available</p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</div>
<!-- end:random-product -->