<?php

use yii\db\Migration;

/**
 * Class m180407_124045_trigger_orders_status
 */
class m180407_124045_trigger_orders_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'CREATE TRIGGER `trgr-orders-update_status` 
	                BEFORE UPDATE ON `yiishop`.`orders`
	                FOR EACH ROW
	                BEGIN
		                SET NEW.updated_at = CURRENT_TIMESTAMP;
	                END;';

        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "DROP TRIGGER update_status";
        $sql = 'DROP TRIGGER IF EXISTS `yiishop`.`trgr-orders-update_status`;';
        $this->execute($sql);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180407_124045_trigger_orders_status cannot be reverted.\n";

        return false;
    }
    */
}
