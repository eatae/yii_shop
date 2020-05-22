<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\ActiveRecord;
use app\modules\admin\models\Customer;
use app\models\User;

/**
 * This is the model class for table "emails".
 *
 * @property int $id
 * @property int $user_id
 * @property int $customer_id
 * @property string $email
 *
 * @property Customer; $customer
 * @property User $user
 */
class Email extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'emails';
    }

    /**
    * @return string
    */
    public function __toString() {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'customer_id' => 'Customer ID',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
