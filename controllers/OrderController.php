<?php
/**
 * Created by PhpStorm.
 * User: Toha
 * Date: 07.04.2018
 * Time: 18:49
 */

namespace app\controllers;

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

    /**
     * Show customer form
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
     * @return string
     */
    public function actionCreateOrder()
    {
        $cart = new ShoppingCart();
        $user = Yii::$app->user->identity;
        $formModel = new CustomerForm();
        $customer_id = ($user) ? $user->customer->id : null;

        $transaction = Yii::$app->db->beginTransaction();

        try {
            if ( $formModel->load(Yii::$app->request->post()) && $customer = $formModel->fillModel( $customer_id )) {
                /* set order */
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