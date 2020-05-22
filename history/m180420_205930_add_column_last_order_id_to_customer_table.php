<?php

use yii\db\Migration;

/**
 * Class m180420_205930_add_column_last_order_id_to_customer_table
 */
class m180420_205930_add_column_last_order_id_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('customers', 'last_order_id', $this->integer(11)->notNull());

        $this->addForeignKey(
            'fk-last_order_id-order_id',
            'customers',
            'last_order_id',
            'orders',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('customers', 'last_order_id');

        $this->dropForeignKey(
            'fk-last_order_id-order_id',
            'customers'
        );
        return false;
    }

}
