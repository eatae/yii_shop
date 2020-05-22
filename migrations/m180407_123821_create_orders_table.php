<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `orders`.
 */
class m180407_123821_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(11),
            'created_at' => $this->timestamp()->notNull()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'qty' => $this->integer(5)->notNull(),
            'sum' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull()->comment('0 or 1'),
        ]);

        $this->addForeignKey(
            'fk-orders-customer_id',
            'orders',
            'customer_id',
            'customers',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('orders');
    }
}
