<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%productOut}}`.
 */
class m231222_160454_create_productOut_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product_out', [
            'id' => $this->primaryKey(),
            'invoice' => $this->string(50)->notNull(),
            'userId' => $this->integer(11)->notNull(),
            'productId' => $this->integer(11)->notNull(),
            'qtyOut' => $this->integer(11)->notNull(),
            'datePublished' => $this->date()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product_out');
    }
}
