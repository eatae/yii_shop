<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'О нас';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<!-- begin:article -->
<div class="row">
    <div class="col-md-3 col-sm-4 sidebar">
        <div class="row">
            <div class="col-md-12">
                <div class="widget">
                    <h3>Lorem ipsum</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Fusce varius quam elementum metus vulputate lacinia. Class aptent taciti sociosqu ad.</p>
                </div>

                <div class="widget">
                    <h3>Lorem ipsum dolor</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a lorem eget dui lacinia ullamcorper. Nunc a mi ipsum, at porta odio. Vivamus hendrerit, massa et molestie bibendum, lacus neque.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9 col-sm-8 content">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">About</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>About Us <small>Subtext for header</small></h2>
                </div>

                <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis.</p>
                    <small>Someone famous in <cite title="">Body of work</cite></small>
                </blockquote>

                <h3>Who we are ?</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quis mi quis purus consectetur adipiscing vel eget nibh.
                    Vivamus sed tortor massa, ac consequat sem. Suspendisse potenti. Donec blandit nibh luctus nibh dignissim vulputate.
                    Sed interdum, augue at pulvinar dapibus, libero nibh semper massa, ut feugiat leo tortor vitae ante.
                    Aliquam erat volutpat. Suspendisse luctus felis sit amet ipsum ornare eget commodo urna pharetra.
                    Duis hendrerit risus ac nulla mattis rhoncus. Praesent iaculis egestas purus et varius.</p>

                <h3>Our team</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quis mi quis purus consectetur adipiscing vel eget nibh.
                    Vivamus sed tortor massa, ac consequat sem. Suspendisse potenti. Donec blandit nibh luctus nibh dignissim vulputate.
                    Sed interdum, augue at pulvinar dapibus, libero nibh semper massa, ut feugiat leo tortor vitae ante.
                    Aliquam erat volutpat. Suspendisse luctus felis sit amet ipsum ornare eget commodo urna pharetra.
                    Duis hendrerit risus ac nulla mattis rhoncus. Praesent iaculis egestas purus et varius.</p>

            </div>
        </div>
    </div>
</div>
<!-- end:article -->
