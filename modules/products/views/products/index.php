<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => "item"
    ]);
    ?>
    <?php /*echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            //'description:ntext',
            'picture' => [
                    "format" => ["image", ['width' => 100]],
                    "value" => function($data) {
                        return $data->picture;
                    }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);*/ ?>
</div>
