<?php

namespace app\models\forms;

use Yii;
use app\models\User;
use yii\base\Model;
use app\models\Customer;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class CustomerForm extends Model
{
    public $first_name;
    public $last_name;
    public $email;
    public $address;
    public $phone;

    //protected $user;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'address', 'phone'], 'required'],

            ['first_name', 'trim'],
            ['first_name', 'string', 'min' => 2, 'max' => 255 ],

            ['last_name', 'trim'],
            ['last_name', 'string', 'min' => 2, 'max' => 255 ],

            ['email', 'trim'],
            ['email', 'email'],

            ['address', 'trim'],
            ['address', 'string', 'min' => 2, 'max' => 255 ],

            ['phone', 'trim'],
            ['phone', 'string', 'min' => 6, 'max' => 255 ],

        ];
    }

    /**
     * @return array
     */
    public function attributeLabels() {
        return [
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'email' => 'email',
            'address' => 'адрес',
            'phone' => 'телефон',
        ];
    }


    /**
     * @param null $customer_id
     * @return Customer|bool
     */
    public function fillModel( $customer_id = null ) : Customer
    {
        if ( $this->validate() ) {
            $customer = ( !$customer_id ) ? new Customer() : Customer::findOne($customer_id);
            $customer->setAttributes($this->toArray(), false); // по причине email
            $customer->save();
            /* set email */
            Customer::setEmail($this->email, $customer->id);

            return $customer;
        }
        return false;
    }
}
