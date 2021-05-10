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






    /********************* TEST ************************/


    public function actionOne()
    {
        $this->redirect( (Yii::$app->request->referrer) ?: Yii::$app->getHomeUrl() );
    }

}