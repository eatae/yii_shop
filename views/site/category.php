<?php

/* @var $this yii\web\View */

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use app\widgets\CategoryListWidget;
use app\widgets\ProductListWidget;

//$this->title = $parent->description;

/* TEST */
//var_dump($products);
?>


<div class="row">
    <hr>


    <!-- begin:sidebar -->
    <div class="col-md-3 col-sm-4 sidebar">
        <!-- Left menu -->
        <div id="left_menu">

            <?= CategoryListWidget::widget( compact('category_parents', 'node', 'ancestors_ids') ); ?>

        </div>
    </div>


    <!-- begin:content -->
    <div class="col-md-9 col-sm-8 content">
        <!-- Ajax Container -->
        <div id="ajax_container">

            <?= ProductListWidget::widget(['pages' => $pages, 'products' => $products]) ?>

        </div>
    </div>
    <!-- end:content -->

</div>

