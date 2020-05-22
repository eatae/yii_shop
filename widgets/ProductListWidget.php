<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

class ProductListWidget extends Widget
{
    public $products;
    public $pages;

    public function run()
    {
        if (!$this->products) { return 'Пустая категория'; }
        ?>
        <div class="row">
            <div class="col-md-12">

                <!-- begind:item -->
                    <? foreach( $this->products as $product ) {
                        static $cnt = 0;
                        if (!($cnt % 3)) { ?>
                        <div class="row product-container">
                        <? } ?>

                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="thumbnail product-item">
                                <a href="<?= Url::to(['product-detail', 'product_id' => $product->id])?>"><img alt="" src="<?= Url::to('@prodImg/'.$product->img) ?>"></a>
                                <div class="caption">
                                    <h5><?= $product->description ?></h5>
                                    <p><?= $product->price ?></p>
                                    <p>Available</p>
                                </div>
                            </div>
                        </div>

                        <? $cnt++;
                        if (!($cnt % 3)) { ?>
                        </div>
                        <? } ?>
                    <? } ?>
                </div>
                <!-- end:item -->

        </div>
        <?
        echo LinkPager::widget([
            'pagination' => $this->pages
        ]);
    }
}