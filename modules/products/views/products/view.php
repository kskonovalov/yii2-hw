<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

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
    <?php
    echo Html::img($model->picture, [
            "alt" => $model->name,
            "class" => "pull-left img-thumbnail",
            "style" => "width: 500px; height: auto; margin: 0 20px 20px 0;"
    ]);
    echo strip_tags($model->description, "<span><dl><dt><div>");
    ?>
    <? /*DetailView::widget([
        'model' => $model,
        'attributes' => [
            'picture' => [
                    "attribute" => "picture",
                    "value" => $model->picture,
                    "format" => ['image', ["class" => "pull-left", "width" => 300]],


            ],
            'description' => [
                "attribute" => 'description',
                "value" => strip_tags($model->description, "<span><dl><dt><div>"),
                "format" => "html"
            ]
        ],
        "template" => "{value}"
    ])*/ ?>

</div>
