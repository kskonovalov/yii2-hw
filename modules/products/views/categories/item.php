<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

?>
<div class="product-view col-md-4" style="height: 300px;">
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
            'name' => [
                    "attribute" => "name",
                    "value" => Html::a($model->name, ['view', 'id' => $model->id]),
                    "format" => "html",
            ],
            'picture' => [
                    "attribute" => "picture",
                    "value" => $model->picture,
                    "format" => ['image', ['width' => 70]]
            ],
        ],
        "template" => "<tr><td>{value}</td></tr>"
    ]) ?>
</div>