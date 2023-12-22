<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property int $id
 * @property string $invoice
 * @property int $userId
 * @property string $transactionCode
 * @property int $initialQty
 * @property int $transactionQty
 * @property string $data
 */
class Transaction extends \yii\db\ActiveRecord
{
    public $fullName;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invoice', 'userId', 'transactionCode', 'initialQty', 'transactionQty', 'data'], 'required'],
            [['userId', 'initialQty', 'transactionQty'], 'integer'],
            [['data'], 'safe'],
            [['invoice', 'transactionCode'], 'string', 'max' => 50],
            [['date'], 'default', 'value' => date('Y-m-d')],
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
            'userId' => 'User',
            'transactionCode' => 'Trx Code',
            'initialQty' => 'Initial Qty',
            'transactionQty' => 'Transaction Qty',
            'data' => 'Data',
        ];
    }
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
    
    public function getProducts(){
        return $this->hasOne(Products::className(), ['id' => 'productId']);
    }
    
    public function getProductIn(){
        return $this->hasOne(ProductIn::className(), ['invoice' => 'transactionCode']);
    }
    
    public function getProductOut(){
        return $this->hasOne(ProductOut::className(), ['invoice' => 'transactionCode']);
    }
    public static function getInvoiceData() {
        $maxInvoice = self::find()->max('invoice');
        if($maxInvoice===null){
            $noInvoice=1;
        }else{
            $noInvoice = (int) substr($maxInvoice, 3, 3);
            $noInvoice++;
        }
        $charInvoice = "TRX";
        $newInvoice = $charInvoice . sprintf("%03s", $noInvoice);

        return $newInvoice;
    }
    
    public static function getListInvoice() {
        return ArrayHelper::map(self::find()->all(), 'id', 'invoice');
    }
}
