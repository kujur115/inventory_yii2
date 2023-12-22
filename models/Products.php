<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $invoice
 * @property string $pName
 * @property string $pCategory
 * @property int $price
 * @property int $Qty
 * @property string|null $pImage
 * @property string $datePublished
 */
class Products extends \yii\db\ActiveRecord
{
    public $_imageProduct;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invoice', 'pName', 'pCategory', 'price', 'Qty', 'datePublished'], 'required'],
            [['price', 'Qty'], 'integer'],
            [['datePublished'], 'default','value'=>date('Y-m-d')],
            [['datePublished'],'safe'],
            [['invoice', 'pName', 'pCategory'], 'string', 'max' => 50],
            [['pImage'], 'string', 'max' => 225],
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
            'pName' => 'Product Name',
            'pCategory' => 'Product Category',
            'price' => 'Price',
            'Qty' => 'Qty',
            'pImage' => 'Product Image',
            'datePublished' => 'Date Published',
        ];
    }

    public function uploadImage(){
        $uploadedFile =UploadedFile::getInstance($this,'_imageProduct');
        $update=Yii::$app->controller->action->id=='update';
        if($uploadedFile){
            $fileDir=Yii::getAlias('@webroot/images/product');
            if(!file_exists($fileDir)){
                FileHelper::createDirectory($fileDir);
            }
            if($update && ($this->_imageProduct!=$this->pImage)){
                unlink(Yii::getAlias('@webroot/images/product/$this->pImage'));
            }
            date_default_timezone_set('Asia/Jakarta');
            $dateTime=date('dmYHis');
            $fileName=strtolower("$this->pName"."$this->invoice");
            if(!uploadedFile->saveAs("$fileDir/".$fileName)){
                return false;
            }
            $this->imageProduct=$fileName;
            return true;
        }else if($update){
            return true;
        }else{
            $this->imageProduct="NA";
            return true;
        }
    }
    
    public function getInvoiceData() {
        $maxInvoice = self::find()->max('invoice');
        if($maxInvoice===null){
            $noInvoice=1;
        }else{
            $noInvoice = (int) substr($maxInvoice, 3, 3);
            $noInvoice++;
        }
        $charInvoice = "INV";
        $newInvoice = $charInvoice . sprintf("%03d", $noInvoice);

        return $newInvoice;
    }

    public static function getListName() {
        return ArrayHelper::map(self::find()->all(), 'id', 'nameProduct');
    }

    public static function getListInvoice() {
        return ArrayHelper::map(self::find()->all(), 'id', 'invoice');
    }
}
