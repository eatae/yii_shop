<?php
/**
 * Created by PhpStorm.
 * User: Toha
 * Date: 07.04.2018
 * Time: 18:49
 */

namespace app\controllers;

use app\models\Email;
use Yii;
use yii\web\Controller;
use app\models\Customer;
use app\models\forms\CustomerForm;
use app\components\DataLayoutTrait;
use app\components\exceptions\CustomException;


class TestController extends Controller
{

    use DataLayoutTrait;


    public function actionIndex()
    {
        $test = [];

        return $this->render('index');
    }


    public function actionShowForm()
    {
        $test = [];
        $customerForm = new CustomerForm();

        if (Yii::$app->request->isPost) { }

        return $this->render('customer_form', compact('customerForm', 'test'));
    }



    public function actionModels()
    {
        $user = Yii::$app->user->identity;
        $email = Email::findOne(3);

        $test = [
            //'email' => $email,
            'user' => $email->user,
            //'identity' => $email->user->findIdentity($email->user_id),
        ];
        return $this->render('models', compact('test'));
    }


    public function actionDebug() {
        phpinfo();
    }


    public function actionLogs() {
        try {
            $except = new CustomException('test_');
            throw $except->errorExcept('message for user');
        } catch (CustomException $e) {
            $e->init();
        }
    }



    public function actionMail() {
        Yii::$app->mailer->compose()
            ->setFrom('al-loco@mail.ru')
            ->setTo('al-loco@mail.ru')
            ->setSubject('Тема сообщения')
            ->setTextBody('Текст сообщения')
            ->setHtmlBody('<b>текст сообщения в формате HTML</b>')
            ->send();
    }

    public function actionUser() {
        $user = Yii::$app->user->identity;
        $email = Email::findOne(1);
        $customer = Customer::findOne(1);

        $user->email = 'foo@mail.ru';
        $user->save();

    }
}