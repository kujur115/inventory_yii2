<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProductIn $model */

$this->title = 'Update Product In: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Ins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-in-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
