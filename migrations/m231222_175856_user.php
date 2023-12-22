<?php

use yii\db\Migration;

/**
 * Class m231222_175856_user
 */
class m231222_175856_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'fullName' => $this->string(50)->notNull(),
            'userName' => $this->string(50)->notNull(),
            'password' => $this->string(255)->notNull(),
            'authKey' => $this->string(255)->notNull(),
            'accessToken' => $this->string(255),
            'role' => $this->integer(11)->notNull(),
            'imageUser' => $this->string(50)->notNull(),
            'active' => $this->integer(11)->notNull()
        ]);
        
        $this->insert('user', [
            'fullName' => 'Administrator',
            'userName' => 'admin',
            'password' => '$2y$13$j2gzOJjz7vID2.CNAFcM/uz/f7bzbKpdbNYi01Cj.Qf.dD3arcKga',
            'authKey' => 'eCDSVGMu92s7-A13HKqd1u4xBQnMSExo',
            'accessToken' => null,
            'role' => User::ROLE_ADMIN,
            'imageUser' => 'default.png',
            'active' => User::STATUS_ACTIVE
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231222_175856_user cannot be reverted.\n";

        return false;
    }
    */
}
