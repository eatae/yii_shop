<?php

namespace app\models;

use Yii;
use app\models\Email;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $phone
 * @property int $last_order_id
 *
 * @property Email $email
 * @property Order $order
 */
class Customer extends ActiveRecord
{

    public static function tableName() {
        return 'customers';
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmail() {
        return $this->hasOne(Email::class, ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders() {
        return $this->hasMany(Order::class, ['customer_id' => 'id']);
    }

    public function setLastOrderId($order_id) {
        $this->last_order_id = $order_id;
        $this->save();
    }



    public static function setEmail($email, $id) {
        Email::setCustomerEmail($email, $id);
    }


}
