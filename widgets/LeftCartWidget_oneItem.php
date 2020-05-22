<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class LeftCartWidget_oneItem extends Widget
{
    public $product;

    public function run()
    {
        ?>
        <li data-product_id="<?= $this->product->id ?>">
            <div class="row">
                <div class="col-sm-12 col-xs-12 product-description">
                    [<span class="product_count"><?= $this->product->quantity; ?></span>] <a href="<?= Url::to(['/product-detail', 'product_id' => $this->product->id]); ?>"><?= $this->product->description; ?></a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12 text-right product-price">
                    <div><strong><?= $this->product->price; ?></strong> <a href="<?= Url::to(['cart/deduct', 'product_id' => $this->product->id])?>" class="trash_product"><i class="fa fa-trash-o"></i></a></div>
                </div>
            </div>
        </li>
        <?
    }
}
