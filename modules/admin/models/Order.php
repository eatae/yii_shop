<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\ActiveRecord;
use app\modules\admin\models\Customer;
use app\modules\admin\models\OrderItems;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $customer_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $qty
 * @property int $sum
 * @property int $status 0 or 1
 *
 * @property OrderItems[] $orderItems
 * @property Customer $customer
 */
class Order extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'qty', 'sum', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['qty', 'sum', 'status'], 'required'],
            //[['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'qty' => 'Qty',
            'sum' => 'Sum',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems() {
        return $this->hasMany(OrderItems::class, ['order_id' => 'id']);
    }


    public static function withOrderItems() {
        return self::find()
            ->with('orderItems')
            ->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer() {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }


    public static function withCustomer() {
        return self::find()
            ->with('customer.email')
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }


    public static function withAll() {
        return self::find()
            ->with('customer')
            ->with('orderItems')
            ->all();
    }

}
