<?php

/* @var $this \yii\web\View
 * @var $content string
 */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\models\Category;
use yii\helpers\Url;

use app\assets\AppAsset;
use app\assets\ltAsset;
use yii\jui\JuiAsset;

/* Register Asset
------------------*/
AppAsset::register($this);
JuiAsset::register($this);
ltAsset::register($this);


/* Params
----------*/
$activeButtons = $this->params['active_buttons'];
$category_roots = $this->params['category_roots'];
$cart_quantity = $this->params['cart_quantity'];


$user = Yii::$app->user->identity;
if (null != $user) {
    $greeting = 'Здравствуйте, '.$user->username ." <a href='".Url::to('/user/logout')."'><button class='btn btn-default btn-xs'> Выйти</button></a>";
} else {
    $greeting = "Здравствуйте, гость  <a href='".Url::to('/user/login')."'><button class='btn btn-default btn-xs'> Войти</button></a>";
}



?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head();
    // для примера:
    //$this->registerJsFile('js/html5shiv.js', ['position' => View::POS_HEAD, 'condition' => 'lte IE9']);
    ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- begin:navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#clotheshop-navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="clotheshop-navbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a class="disabled">CURRENCY</a></li>
                <li class="active"><a href="#">USD</a></li>
                <li><a href="#">EUR</a></li>
                <li><a href="#">IDR</a></li>
                <li class="divider-vertical"></li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">LANGUAGE <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">EN</a></li>
                        <li><a href="#">ID</a></li>
                        <li><a href="#">FR</a></li>
                        <li class="divider"></li>
                        <li><a href="#">IT</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
<!-- end:navbar -->

<!-- begin:content -->
<div class="container">
    <!-- begin:logo -->
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="logo">
                <h1><a href="index.html">Clothe<span>shop</span> </a></h1>
                <p>Clean and simple shopping cart</p>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="account">
                <ul>
                    <li id="your-account">
                        <div class="hidden-xs">
                            <!--<h4><a href="#">Your Account</a></h4>-->
                            <h4>УЧЕТНАЯ ЗАПИСЬ</h4>
                            <p><?= $greeting ?></p>
                        </div>
                        <div class="visible-xs">
                            <a href="login.html" class="btn btn-primary"><i class="fa fa-user"></i></a>
                        </div>
                    </li>
                    <li>
                        <div class="hidden-xs">
                            <h4>Корзина</a></h4>
                            <a href="<?= Url::to('/cart/show'); ?>">
                                <p class="cart_total_count"><?= $cart_quantity; ?></p>
                            </a>
                        </div>
                        <div class="visible-xs">
                            <a href="<?= Url::to('/cart/show'); ?>" class="btn btn-primary"><span class="cart-item cart_total_count"><?= (int)$cart_quantity; ?></span> <i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end:logo -->

    <!-- begin:nav-menus -->
    <div class="row">
        <div class="col-md-12">
            <div class="nav-menus">
                <ul class="nav nav-pills">

                    <!-- Главная -->
                    <li class="<?= $activeButtons['index'] ?>"><?= Html::a('Главная', ['site/index']) ?></li>


                    <!-- Categories Menu Items -->
                    <? foreach ($category_roots as $root) { ?>

                        <? if (!$root instanceof Category) continue; ?>
                        <li class="dropdown <?= $activeButtons[$root->name] ?>">
                            <?= Html::a( "$root->description <b class='caret'></b>", ['site/category'], ['data-toggle' => 'dropdown', 'class' => 'dropdown-toggle']) ?>
                            <ul class="dropdown-menu" id="menu1">

                                <? $parents = $root->children; ?>
                                <? foreach ($parents as $node) { ?>
                                    <li>
                                        <?= Html::a( $node['description'], ['site/category', 'category_id' => $node['id']] ); ?>
                                    </li>
                                <? } ?>

                            </ul>
                        </li>

                    <? } ?>


                    <!-- About -->
                    <li class="<?= $activeButtons['about'] ?>">
                        <?= Html::a('О нас', ['site/about']) ?>
                    </li>

                    <!-- Contact -->
                    <li class="<?= $activeButtons['contact'] ?>">
                        <?= Html::a('Контакты', ['site/contact']) ?>
                    </li>
                    <!-- Contact -->
                    <li>
                        <?= Html::a('TEST', ['test/index']) ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end:nav-menus -->

    <? if ( !empty($message = Yii::$app->session->getFlash('success')) ) { ?>
            <div class="alert alert-success"> <?= $message ?> </div>
    <? } //endif ?>

    <? if ( !empty($exceptMsg = Yii::$app->session->getFlash('exceptionMsg')) ) { ?>
        <div class="alert alert-danger"> <?= $exceptMsg ?> </div>
    <? } //endif ?>


    <? echo $content ?>



    <!-- begin:footer -->
    <div class="row">
        <div class="col-sm-12 footer">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3><span>Contact Info</span></h3>
                        <address>
                            No. 22, Bantul, Yogyakarta, Indonesia<br>
                            Call Us : (0274) 4411005<br>
                            Email : avriqq@gmail.com<br>
                        </address>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3><span>Customer Support</span></h3>
                        <ul class="list-unstyled list-star">
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Payment Option</a></li>
                            <li><a href="#">Booking Tips</a></li>
                            <li><a href="#">Information</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3><span>Discover our store</span></h3>
                        <ul class="list-unstyled list-star">
                            <li><a href="#">California</a></li>
                            <li><a href="#">Bali</a></li>
                            <li><a href="#">Singapore</a></li>
                            <li><a href="#">Canada</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3><span>Get Our Newsletter</span></h3>
                        <p>Subscribe to our newsletter and get exclusive deals straight to your inbox!</p>
                        <form>
                            <input type="email" class="form-control" name="email" placeholder="Your Email : "><br>
                            <input type="submit" class="btn btn-warning" value="Subscribe">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end:footer -->

    <!-- begin:copyright -->
    <div class="row">
        <div class="col-md-12 copyright">
            <div class="row">
                <div class="col-md-6 col-sm-6 copyright-left">
                    <p>Copyright &copy; Clotheshop 2012-<?= date('Y')?>. All right reserved.</p>
                </div>
                <div class="col-md-6 col-sm-6 copyright-right">
                    <ul class="list-unstyled list-social">
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end:copyright -->

</div>
<!-- end:content -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
