<?php

use yii\db\Migration;

/**
 * Class m231222_152310_products
 */
class m231222_152310_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products',[
            'id' => $this->primaryKey(),
            'pId'=>$this->string(50)->notNull(),
            'pName'=>$this->string(50)->notNull(),
            'pCategory'=>$this->string(50)->notNull(),
            'price'=>$this->integer(11)->notNull(),
            'Qty'=>$this->integer(11)->notNull(),
            'pImage'=>$this->string(225),
            'datePublished'=>$this->date()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // echo "m231222_152310_products cannot be reverted.\n";

        // return false;
        $this->dropTable('products');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231222_152310_products cannot be reverted.\n";

        return false;
    }
    */
}
