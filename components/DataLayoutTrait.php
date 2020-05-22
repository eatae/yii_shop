<?php

namespace app\components;

use app\models\Category;
use app\models\Product;
use yz\shoppingcart\ShoppingCart;

/**
 * Trait DataLayoutTrait - used in Controllers
 * @package app\components
 * @property  @this  static::yii\web\Controllers
 */

trait DataLayoutTrait
{
    protected $cart;
    protected $category_roots;

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

}