<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transaction}}`.
 */
class m231222_160746_create_transaction_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transaction}}', [
            'id' => $this->primaryKey(),
            'invoice' => $this->string(50)->notNull(),
            'userId' => $this->integer(11)->notNull(),
            'codeTrx' => $this->string(50)->notNull(),
            'stockFirst' => $this->integer(11)->notNull(),
            'qtyTrx' => $this->integer(11)->notNull(),
            'stockFinal' => $this->integer(11)->notNull(),
            'datePublished' => $this->date()->notNull()
        ]);
        
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%transaction}}');
    }
}
