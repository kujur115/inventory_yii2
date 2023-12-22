<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProductIn $model */

$this->title = 'Create Product In';
$this->params['breadcrumbs'][] = ['label' => 'Product Ins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-in-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
