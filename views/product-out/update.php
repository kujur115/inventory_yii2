<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProductOut $model */

$this->title = 'Update Product Out: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Outs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-out-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
