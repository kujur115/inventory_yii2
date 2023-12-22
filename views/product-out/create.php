<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProductOut $model */

$this->title = 'Create Product Out';
$this->params['breadcrumbs'][] = ['label' => 'Product Outs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-out-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
