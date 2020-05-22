<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_items`.
 */
class m180407_124518_create_order_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "DROP TABLE IF EXISTS `yiishop`.`order_items`";
        $this->execute($sql);

        $this->createTable('order_items', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer(10)->notNull()->unsigned(),
            'price' => $this->money(9, 2)->notNull(),
            'qty' => $this->integer()->notNull(),
            'cost' => $this->money(9, 2)->notNull(),
        ]);

        $this->addForeignKey(
            'fk-order_items-order_id',
            'order_items',
            'order_id',
            'orders',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk-order_items-product_id',
            'order_items',
            'product_id',
            'product',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('order_items');
    }
}
