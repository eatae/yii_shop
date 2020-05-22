<?php

namespace app\controllers;

use app\components\exceptions\CustomException;
use app\models\forms\SignupForm;
use app\models\forms\LoginForm;
use Yii;
use yii\web\Controller;
use app\models\Category;
use app\models\Product;
use yz\shoppingcart\ShoppingCart;



class UserController extends Controller
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



    /**
     * @return string|\yii\web\Response
     */
    public function actionSignup()
    {
        $transaction = Yii::$app->db->beginTransaction();
        $signupForm = new SignupForm();
        $loginForm = new LoginForm();
        try {
            if ( Yii::$app->user->isGuest && $signupForm->load(Yii::$app->request->post()) && $user = $signupForm->save() ) {
                Yii::$app->session->setFlash('success', 'Регистрация прошла успешно.');
                $transaction->commit();
                Yii::$app->user->login( $user );

                return $this->redirect( /*(Yii::$app->request->referrer) ?:*/ Yii::$app->getHomeUrl());
            }
        } catch (CustomException $e) {
            $transaction->rollBack();
            $e->init();
        }
        return $this->render('signup', compact('signupForm', 'loginForm'));
    }




    public function actionLogin()
    {
        $signupForm = new SignupForm();
        $loginForm = new LoginForm();
        if ( Yii::$app->user->isGuest && $loginForm->load(Yii::$app->request->post()) && $loginForm->login() ) {
            Yii::$app->session->setFlash('success', 'Вы успешно авторизированы.');
            return $this->redirect( Yii::$app->session->getFlash('go_back') ?: Yii::$app->getHomeUrl());
        }
        Yii::$app->session->setFlash('go_back', Yii::$app->request->referrer);
        return $this->render('login', compact('signupForm', 'loginForm'));
    }


    public function actionLogout()
    {
        Yii::$app->user->logout(false);
        return $this->redirect( /*(Yii::$app->request->referrer) ?:*/ Yii::$app->getHomeUrl());
    }






    /********************* TEST ************************/


    public function actionOne()
    {
        $this->redirect( (Yii::$app->request->referrer) ?: Yii::$app->getHomeUrl() );
    }

}