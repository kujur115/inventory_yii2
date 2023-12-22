<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productout".
 *
 * @property int $id
 * @property string $invoice
 * @property int $userId
 * @property int $productId
 * @property int $qtyOut
 * @property string $date
 */
class ProductOut extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productout';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invoice', 'userId', 'productId', 'qtyOut', 'date'], 'required'],
            [['userId', 'productId', 'qtyOut'], 'integer'],
            [['date'], 'safe'],
            [['invoice'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice' => 'Invoice',
            'userId' => 'User ID',
            'productId' => 'Product ID',
            'qtyOut' => 'Qty Out',
            'date' => 'Date',
        ];
    }
}
