<?php

use yii\db\Migration;

/**
 * Handles the creation of table `emails`.
 */
class m180407_123725_create_emails_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('emails', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->defaultValue(null),
            'customer_id' => $this->integer()->defaultValue(null),
            'email' => $this->string()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-emails-user_id',
            'emails',
            'user_id',
            'users',
            'id',
            'SET NULL'
        );

        $this->addForeignKey(
            'fk-emails-customer_id',
            'emails',
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
        $this->dropTable('emails');
    }
}
