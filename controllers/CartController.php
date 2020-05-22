<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\models\Category;
use app\models\Product;
use yz\shoppingcart\ShoppingCart;
use app\widgets\LeftCartWidget_oneItem;
use yii\web\NotFoundHttpException;
use app\models\forms\ChangeCartPositionForm;


class CartController extends Controller
{
    protected $category_roots;
    protected $cart;
    protected $errorMsg = [
        'notAjax' => 'Ошибка метода запроса',
        'notPostParam' => 'Нет необходимого параметра',
        'badId' => 'На данный момент такого продукта нет',
        'notValid' => 'Данные не прошли проверку',
    ];


    public function getCart() : ShoppingCart {
        if ( empty($this->cart) ) {
            $this->cart = new ShoppingCart();
        }
        return $this->cart;
    }

    public function beforeAction($action)
    {
        /* get all roots */
        $this->category_roots = Category::find()->roots()->all();
        /* set category_roots in main for draw topMenu */
        $this->view->params['category_roots'] = $this->category_roots;
        /* set quantity products */
        $this->view->params['cart_quantity'] = Product::getQuantityWord($this->getCart());

        return parent::beforeAction($action);
    }



    public function actionShow()
    {
        $cart = $this->getCart();
        $modelForm = new ChangeCartPositionForm();

        $this->view->registerJsFile('js/Cart.js', ['depends' => 'app\assets\AppAsset']);
        $this->view->registerJsFile('js/jquery-validation/dist/jquery.validate.js', ['depends' => 'app\assets\AppAsset']);
        $this->view->registerJsFile('js/cart_show.js', ['depends' => 'app\assets\AppAsset']);
        return $this->render('show', ['cart'=>$cart, 'modelForm' => $modelForm]);
    }






    public function actionAdd()
    {
        $cart = $this->getCart();
        /* post param */
        $product_id = Yii::$app->request->post('product_id') ?: null;
        $quantity = (int)Yii::$app->request->post('quantity') ?: null;
        $get_html = Yii::$app->request->post('get_html');

        /* check AJAX */
        if (false == Yii::$app->request->isAjax) {
            throw new NotFoundHttpException($this->errorMsg['notAjax']);
            /* check $post */
        } elseif ( false == Yii::$app->request->isPost || !$product_id || !$quantity ) {
            throw new NotFoundHttpException($this->errorMsg['notPostParam']);
            /* check $product_id, get $product */
        } elseif ( !$product = Product::findOne(Yii::$app->request->post('product_id')) ) {
            throw new NotFoundHttpException($this->errorMsg['badId']);
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        $cart->put($product, $quantity);
        $html_block = ( empty($get_html) ) ? null : LeftCartWidget_oneItem::widget(['product'=>$product]);

        $response = [
            'count'      => Product::getQuantityWord($this->cart),
            'html_block' => $html_block,
            'cost'       => sprintf( "%.2f", $cart->getCost()),
        ];

        return $response;
    }




    public function actionDeduct()
    {
        $cart = $this->getCart();
        /* post param */
        $product_id = Yii::$app->request->post('product_id') ?: null;
        /* check AJAX */
        if (false == Yii::$app->request->isAjax) {
            throw new NotFoundHttpException($this->errorMsg['notAjax']);
            /* check $post */
        } elseif ( false == Yii::$app->request->isPost || !$product_id ) {
            throw new NotFoundHttpException($this->errorMsg['notPostParam']);
            /* check $position */
        } elseif ( !$position = $cart->getPositionById(Yii::$app->request->post('product_id')) ) {
            throw new NotFoundHttpException($this->errorMsg['badId']);
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        $position->quantity -= 1;
        if ($position->quantity < 1) { $cart->remove($position); }
        $cart->saveToSession();

        $response = [
            'prod_count' => $position->quantity,
            'totalCount' => Product::getQuantityWord($cart),
            'cost' => sprintf( "%.2f", $cart->getCost()),

        ];
        return $response;
    }



    public function actionUpdate()
    {
        $cart = $this->getCart();
        $modelForm = new ChangeCartPositionForm();
        /* check AJAX */
        if ( false == Yii::$app->request->isAjax ) {
            throw new NotFoundHttpException($this->errorMsg['notAjax']);
        }
        elseif ( !$modelForm->load(Yii::$app->request->post()) ) {
            throw new NotFoundHttpException($this->errorMsg['notPostParam']);
        }
        elseif ( !$modelForm->validate() ) {
            throw new NotFoundHttpException($this->errorMsg['notValid']);
        }
        elseif ( !$position = $cart->getPositionById($modelForm->product_id) ) {
            throw new NotFoundHttpException($this->errorMsg['badId']);
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        $position->setQuantity($modelForm->quantity);
        $cart->saveToSession();

        $response = [
            'prod_cost' => sprintf( "%.2f", $position->cost),
            'cost' => sprintf( "%.2f", $cart->cost),
            'totalCount' => Product::getQuantityWord($cart),
        ];
        return $response;
    }



    public function actionDelete()
    {
        $cart = $this->getCart();
        $modelForm = new ChangeCartPositionForm();
        /* check AJAX */
        if ( false == Yii::$app->request->isAjax ) {
            throw new NotFoundHttpException($this->errorMsg['notAjax']);
        }
        elseif ( !$modelForm->load(Yii::$app->request->post()) ) {
            throw new NotFoundHttpException($this->errorMsg['notPostParam']);
        }
        elseif ( !$modelForm->validate() ) {
            throw new NotFoundHttpException($this->errorMsg['notValid']);
        }
        elseif ( !$position = $cart->getPositionById($modelForm->product_id) ) {
            throw new NotFoundHttpException($this->errorMsg['badId']);
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        $cart->remove($position);
        //$cart->saveToSession();

        $response = [
            'cost' => sprintf( "%.2f", $cart->cost),
            'totalCount' => Product::getQuantityWord($cart),
        ];
        return $response;
    }


}