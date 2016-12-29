<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\modules\products\models\Categories */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
        ],
    ]) ?>

    <?php
    foreach($products as $product) {
    echo DetailView::widget([
        'model' => $product,
        'attributes' => [
            'name' => [
                "attribute" => "name",
                "value" => Html::a($product->name, ['view', 'id' => $product->id]),
                "format" => "html",
            ],
            'picture' => [
                "attribute" => "picture",
                "value" => $product->picture,
                "format" => ['image', ['width' => 70]]
            ],
        ],
        "template" => "<tr><td>{value}</td></tr>"
    ]);
    }
    ?>

</div>
