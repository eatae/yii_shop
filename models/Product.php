<?php

namespace app\models;

use yii\db\ActiveRecord;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;
use yz\shoppingcart\ShoppingCart;


class Product extends ActiveRecord implements CartPositionInterface
{
    use CartPositionTrait;

    public static function tableName()
    {
        return 'product';
    }


    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id'=>'category_id']);
    }

    /* shopping cart */

    public function getPrice()
    {
        return $this->price;
    }

    public function getId()
    {
        return $this->id;
    }

    public static function getQuantityWord(ShoppingCart $cart)
    {
        $n = $cart->count ?: 0;
        $words = ['товар', 'товара', 'товаров'];
        $ind = ($n % 10 == 1 && $n % 100 != 11 ? 0 : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20) ? 1 : 2));
        return $n. ' ' .$words[$ind];
    }
}