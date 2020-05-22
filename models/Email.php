<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\components\exceptions\CustomException;

/**
 * This is the model class for table "emails".
 *
 * @property int $id
 * @property int $user_id
 * @property int $customer_id
 * @property string $email
 *
 * @property Customer $customer
 * @property User $user
 */
class Email extends ActiveRecord
{

    /**
     * @return string
     */
    public function __toString() {
        return $this->email;
    }

    public static function tableName() {
        return 'emails';
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer() {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


    public static function findByUserId($user_id) {
        return self::findOne(['user_id'=>$user_id]);
    }


    public static function findByCustomerId($customer_id) {
        return self::findOne(['customer_id'=>$customer_id]);
    }



    public static function setCustomerEmail($customer_email, $customer_id) {
        $user = Yii::$app->user->identity;
        $email = ($user) ? $user->email : null;
        /* if this user has the same email  */
        if ( (string) $email == $customer_email ) {
            $email->customer_id = $customer_id;
        }
        /* add new email */
        else {
            $email = new self();
            $email->email = $customer_email;
            $email->customer_id = $customer_id;
        }
        if (!$email->save()) {
            $except = new CustomException('Ошибка добавления email покупателя | addCustomerEmail()');
            throw $except->errorExcept('Невозможно добавить email');
        }
    }



    public static function setUserEmail($user_email, $user_id) {
        if ($email = self::findByUserId($user_id)) {
            $email->email = $user_email;
        }
        else {
            $email = new self();
            $email->email = $user_email;
            $email->user_id = $user_id;
        }
        if (!$email->save()) {
            $except = new CustomException('Ошибка добавления email покупателя | addCustomerEmail()');
            throw $except->errorExcept('Невозможно добавить email');
        }
    }





    /**
     * @inheritdoc
     */
    /*public function rules()
    {
        return [
            [['user_id', 'customer_id'], 'integer'],
            [['email'], 'required'],
            [['email'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }*/

    /**
     * @inheritdoc
     */
    /*public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'customer_id' => 'Customer ID',
            'email' => 'Email',
        ];
    }*/

}
