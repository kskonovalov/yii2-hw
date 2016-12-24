<?php

namespace app\components\widgets;
use yii\base\Widget;

class MapWidget extends Widget
{
    public $width;
    public $height;
    public function run(){
        $width = ((int)$this->width > 0) ? $this->width : 500;
        $height = ((int)$this->height > 0) ? $this->height : 400;
        echo "
        <script type=\"text/javascript\" charset=\"utf-8\" async src=\"https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=KS2T_qpSp_doqCxBtTp2w9XNeKg2KOok&amp;width={$width}&amp;height={$height}&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true\"></script>
        ";
    }
}