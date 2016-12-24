<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\components\widgets\MapWidget;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Hello)
    </p>
<?=MapWidget::widget([
    "width" => "1000",
    "height" => "300"
]);?>
</div>
