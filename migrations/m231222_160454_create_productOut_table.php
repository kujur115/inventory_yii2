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
        $this->createTable('{{%productOut}}', [
            'id' => $this->primaryKey(),
            'invoice' => $this->string(50)->notNull(),
            'userId'=>$this->integer(11)->notNull(),
            'productId'=>$this->integer(11)->notNull(),
            'qtyOut'=>$this->integer(11)->notNull(),
            'date'=>$this->date()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%productOut}}');
    }
}
