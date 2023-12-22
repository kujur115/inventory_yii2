<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%productIn}}`.
 */
class m231222_155728_create_productIn_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%productIn}}', [
            'id' => $this->primaryKey(),
            'invoice' => $this->string(50)->notNull(),
            'userId'=>$this->integer(11)->notNull(),
            'productId'=>$this->integer(11)->notNull(),
            'qtyIn'=>$this->integer(11)->notNull(),
            'date'=>$this->date()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%productIn}}');
    }
}
