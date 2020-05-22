<?php

namespace app\modules\admin\models;

use Yii;
use \yii\db\ActiveRecord;
use app\modules\admin\models\Order;
use app\modules\admin\models\Email;

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
 * @property Email[] $email
 * @property Order[] $order
 */
class Customer extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'address', 'phone', 'last_order_id'], 'required'],
            [['last_order_id'], 'integer'],
            [['first_name', 'last_name', 'address', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'last_order_id' => 'Last Order ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmail()
    {
        return $this->hasMany(Email::class, ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasMany(Order::class, ['customer_id' => 'id']);
    }
}
