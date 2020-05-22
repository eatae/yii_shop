<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\Customer;
/**
 * Class User
 *
 * @prop  int          $id
 * @prop  string       $username
 * @prop  string       $email
 * @prop  string       $auth_key
 * @prop  string       $password_hash
 * @prop  string|null  $password_reset_token
 * @prop  int          $status  [default=10]
 * @prop  int|null     $customer_id
 * @prop  timestamp    $created_at
 * @prop  timestamp    $updated_at
 *
 *
 * @package app\models
 */
class User extends ActiveRecord implements IdentityInterface
{
    const ADMIN_STATUS = 100;

    //public $mail;

    public static function tableName() {
        return 'users';
    }

    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }


    public static function findByEmail($email) {
        $email = Email::findOne(['email'=>$email]);
        return User::findOne($email->user_id);
    }


    public function saveCustomerId($customer_id) {
        if ($this->customer_id) {
            return;
        }
        $this->customer_id = $customer_id;
        $this->save();
    }

    /**
     * @return null|Customer
     */
    public function getCustomer() {
        return $this->hasOne(Customer::class, ['id'=>'customer_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmail() {
        //return Email::findByUserId($this->id);
        return $this->hasOne(Email::class, ['user_id' => 'id']);
    }

    public static function setEmail($email, $id) {
        Email::setUserEmail($email, $id);
    }


    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }




    public function getId() {
        return $this->id;
    }

    public function getAuthKey() {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }
}