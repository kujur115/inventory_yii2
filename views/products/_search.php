<?php
use app\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\View;
use app\models\Products;
use yii\jui\DatePicker;

/* @var $this View */
/* @var $model MsUser */
?>
<div class="panel panel-search">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Filter</h4>
    </div>
    <div class="panel-body">
        <?php
        $form = ActiveForm::begin([
            'method' => 'GET',
            'action' => ['index'],
            'options' => [
                'data-pjax' => false,
                'class' => 'form-filter',
            ],
        ]);

        echo $form->field($model, 'invoice')->dropDownList(Products::getListInvoice(), ['prompt' => 'Select Item']);

        echo $form->field($model, 'nameProduct')->textInput(['placeholder' => 'Enter Name Product...']);

        echo $form->field($model, 'typeProduct')->textInput(['placeholder' => 'Enter Type Product...']);

        echo $form->field($model, 'unit')->dropDownList(Products::$unitCategories, ['prompt' => 'Select Item']);

        echo $form->field($model, 'price')->textInput(['placeholder' => 'Enter Price...']);

        echo $form->field($model, 'stockFirst')->textInput(['placeholder' => 'Enter Stock First...']);

        echo $form->field($model, 'stockIn')->textInput(['placeholder' => 'Enter Stock In...']);

        echo $form->field($model, 'stockOut')->textInput(['placeholder' => 'Enter Stock Out...']);

        echo $form->field($model, 'stockFinal')->textInput(['placeholder' => 'Enter Stock Final...']);

        echo $form->field($model, 'fromDate')->widget(DatePicker::class, [
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control'],
        ]);

        echo $form->field($model, 'toDate')->widget(DatePicker::class, [
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control'],
        ]);

        echo $form->field($model, 'active')->dropDownList(Products::$activeCategories, ['prompt' => 'Select Item']);

        ?>
        <div class="form-group text-right">
            <?= Html::submitButton('<i class="glyphicon glyphicon-search with-text"></i> Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="glyphicon glyphicon-remove with-text"></i> Reset', ['index'], ['class' => 'btn btn-danger']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
