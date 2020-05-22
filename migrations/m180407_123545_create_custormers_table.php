<?php

use yii\db\Migration;

/**
 * Handles the creation of table `custormers`.
 */
class m180407_123545_create_custormers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('customers', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'phone' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('custormers');
    }
}
