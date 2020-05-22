<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yz\shoppingcart\ShoppingCart;
use app\components\exceptions\CustomException;

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
 * @property Customers $customer
 */
class Order extends ActiveRecord
{

    public static function tableName() {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    /*public function rules()
    {
        return [
            [['customer_id', 'qty', 'sum', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['qty', 'sum', 'status'], 'required'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }*/

    /**
     * @inheritdoc
     */
    /*public function attributeLabels()
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
    }*/

    public static function setOrder(Customer $customer, ShoppingCart $cart) : Order
    {
        if ( $cart->isEmpty ) {
            $except = new CustomException('Пользователь '. $customer->email .' пытается оформить пустой заказ.');
            throw $except->warningExcept('Ваша корзина пуста');
        }
        $order = new self();
        $order->customer_id = $customer->id;
        $order->qty = $cart->count;
        $order->sum = $cart->cost;
        if ( !$order->save() ) {
            $except = new CustomException('Ошибка при оформлении заказа || setOrder()');
            throw $except->errorExcept('Не удаётся оформить заказ');
        }
        return $order;
    }



    public static function setOrderItems(Order $order, ShoppingCart $cart)
    {
        $query = Yii::$app->db->createCommand( 'INSERT INTO order_items(order_id, product_id, price, qty, cost) 
                                                      VALUES(:order_id, :product_id, :price, :qty, :cost)' );
        try {
            foreach ($cart->getPositions() as $position ) {
                $query->bindValues([
                    ':order_id'=>$order->id,
                    ':product_id'=>$position->id,
                    ':price'=>$position->price,
                    ':qty'=>$position->quantity,
                    ':cost'=>$position->cost,
                ])->execute();
            }
        } catch (\Throwable $e) {
            /* if throw yii exception - throw CustomException */
            $except = new CustomException( $e->getMessage() . '|| setOrderItems()');
            throw $except->errorExcept('Не удаётся оформить заказ');
        }
    }



    public function getOrderItems() {
        //return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
        return Yii::$app->db->createCommand('SELECT * FROM `order_items` WHERE order_id=:id')
            ->bindValue(':id', $this->id)
            ->queryAll();
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }
}
