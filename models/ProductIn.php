<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productin".
 *
 * @property int $id
 * @property string $invoice
 * @property int $userId
 * @property int $productId
 * @property int $qtyIn
 * @property string $date
 */
class ProductIn extends \yii\db\ActiveRecord
{

    public $fullName;
    public $productName;
    public $productCategory;
    public $price;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['invoice', 'userId', 'productId', 'qtyIn', 'date'], 'required'],
            [['userId', 'productId', 'qtyIn'], 'integer'],
            [['date'], 'safe'],
            [['invoice'], 'string', 'max' => 45],
            [['date'],'default','value'=>date('Y-m-d')],
            [['date','fullName','productName','productCategory','price'],'safe']
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
            'productId' => 'Product',
            'qtyIn' => 'Qty',
            'date' => 'Date',
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
    
    public function getProducts(){
        return $this->hasOne(Products::className(), ['id' => 'productId']);
    }
    
    public function getInvoiceData() {
        $maxInvoice = self::find()->max('invoice');
        if($maxInvoice===null){
            $noInvoice=1;
        }else{
            $noInvoice = (int) substr($maxInvoice, 3, 3);
            $noInvoice++;
        }
        $charInvoice = "PIN";
        $newInvoice = $charInvoice . sprintf("%03s", $noInvoice);
        
        return $newInvoice;
    }
    public static function getListInvoice() {
        return ArrayHelper::map(self::find()->all(), 'id', 'invoice');
    }
    
    public function createTransaction($dataUpdate = false, $dataInvoice = null){
        if ($dataUpdate){
            $modelTransaction = Transaction::findOne(['transactionCode' => $dataInvoice]);
        }else{
            $modelTransaction = new Transaction();
            $modelTransaction->invoice = Transaction::getInvoiceData();
        }
        $modelTransaction->userId = $this->userId;
        $modelTransaction->codeTrx = $this->invoice;
        $modelTransaction->stockFirst = $this->products->stockFirst;
        $modelTransaction->qtyTrx = $this->qtyIn;
        $modelTransaction->stockFinal = $this->products->stockFinal;
        
        return $modelTransaction->save();
    }
}
