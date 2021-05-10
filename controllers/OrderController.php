<?php
/**
 * Created by PhpStorm.
 * User: Toha
 * Date: 07.04.2018
 * Time: 18:49
 */

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use yii\web\Controller;
use app\models\Customer;
use app\models\Order;
use yz\shoppingcart\ShoppingCart;
use app\models\forms\CustomerForm;
use app\components\DataLayoutTrait;
use app\components\exceptions\CustomException;

class OrderController extends Controller
{
    use DataLayoutTrait;


    public function beforeAction($action)
    {
        $top_button = $action->id;
        /* get all roots */
        $this->category_roots = Category::find()->roots()->all();
        /* set category_roots in main for draw topMenu */
        $this->view->params['category_roots'] = $this->category_roots;
        /* set quantity products */
        $this->view->params['cart_quantity'] = Product::getQuantityWord($this->getCart());
        $this->view->params['active_buttons'] = $this->setTopMenuButtons( $this->category_roots, $top_button );

        return parent::beforeAction($action);
    }

    /**
     * Show customer form
     *
     * @return string
     */
    public function actionCustomerForm()
    {
        $formModel = new CustomerForm();
        $user = Yii::$app->user->identity;

        $cart = new ShoppingCart();
        try {
            if ($cart->isEmpty) {
                $except = new CustomException( 'Пустая корзина || actionCustomerForm()');
                throw $except->infoExcept('Чтобы оформить заказ необходимо выбрать товар.');
            }
        } catch (CustomException $e) {
            $e->init();
        }

        return $this->render('customer_form', compact('formModel', 'user'));
    }


    /**
     * Create order
     *
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionCreateOrder()
    {
        $cart = new ShoppingCart();
        $user = Yii::$app->user->identity;
        $formModel = new CustomerForm();

        $transaction = Yii::$app->db->beginTransaction();

        //dd($customer_id);
        /* тут оказия если пользователя нет */
        if (!$user) {
            return Yii::$app->runAction('site/index');
        }
        /* и тут оказия если customer нет */
        if ( !isset($user->customer->id)) {
            return Yii::$app->runAction('site/index');
        }


        try {
            if ( $formModel->load(Yii::$app->request->post()) && $customer = $formModel->fillModel( $user->customer->id)) {
                /* set order */


                dd($customer);
                $order = Order::setOrder($customer, $cart);
                /* set order-items */
                Order::setOrderItems($order, $cart);
                /* set last_order_id */
                $customer->setLastOrderId($order->id);
                if (!empty($user)) {
                    $user->saveCustomerId($customer->id);
                }
                $this->sendOrderEmail($customer, $order);
                Yii::$app->session->setFlash('success', 'Спасибо за заказ.', false);
                $cart->removeAll();
                $this->redirect(Yii::$app->getHomeUrl());
            }

            $transaction->commit();

        } catch (CustomException $e) {
            $transaction->rollBack();
            $e->init();
        }
        return $this->render('customer_form', compact('formModel', 'user'));
    }


    /**
     * @param Customer $customer
     * @param Order $order
     * @throws CustomException
     */
    public function sendOrderEmail(Customer $customer, Order $order) {
        try {
            Yii::$app->mailer->compose()
                ->setFrom('al-loco@mail.ru')
                ->setTo((string)$customer->email)
                ->setSubject('Заказ №' . $order->id)
                ->setTextBody($customer->first_name . ', ваш заказ № '. $order->id . ', спасибо за доверие.')
                ->send();
        } catch (\Throwable $e) {
            $except = new CustomException( $e->getMessage() . '|| sendOrderEmails()');
            throw $except->errorExcept('Не удаётся оформить заказ, такого email нет.');
        }
    }




    /**
     * Fill top menu
     *
     * @param array $category_roots
     * @param string $top_button
     * @return array
     */
    protected function setTopMenuButtons(array $category_roots, $top_button = null)
    {
        $top_button =  $top_button ?: 'index';
        $activeButtons = [ 'index' => '', 'about' => '', 'contact' => ''];
        /* add Category button in menu */
        if ( !empty($category_roots) ) {
            foreach ($category_roots as $root) {
                $activeButtons[$root->name] = '';
            }
        }
        /* set class 'active' for button */
        if ( array_key_exists($top_button, $activeButtons) ) {
            $activeButtons[$top_button] = 'active';
        }
        return $activeButtons;
    }



    /******** TEST **********/
    /***********************/

    public function actionTest()
    {

        $test = [
            'key' => 'value',
        ];
        return $this->render('test', compact('test'));

    }



}
