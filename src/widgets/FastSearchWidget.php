<?php

namespace kordar\highcharts\widgets;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * Class FastSearchWidget
 * @package kordar\hchart\widgets
 * @item *:FastSearchWidget
 */
class FastSearchWidget extends Widget
{
    /**
     * @var
     */
    public $data = [
        '最近7天' => 7,
        '最近30天' => 30,
        '上月' => 'lastMonth',
        '本月' => 'nowMonth',
    ];

    public $urlCallback;

    public function run()
    {
        $time = time();

        foreach ($this->data as $key => $val) {

            $startTime = $endTime = 0;

            if (is_numeric($val)) {
                $startTime = strtotime('-' . $val . ' day', $time);
                $endTime = $time;
            } elseif ($val == 'lastMonth') {
                $lastTime = strtotime('-1 month', $time);
                $startTime = mktime(0,0,0, date('m', $lastTime),1, date('Y', $lastTime));
                $endTime = mktime(23,59,59, date('m', $lastTime), date('t', $lastTime), date('Y', $lastTime));
            } elseif ($val == 'nowMonth') {
                $startTime = mktime(0,0,0, date('m', $time),1, date('Y', $time));
                $endTime = mktime(23,59,59, date('m', $time), date('t', $time), date('Y', $time));
            }

            if ($startTime && $endTime) {
                $url = call_user_func($this->urlCallback, date('Y-m-d', $startTime), date('Y-m-d', $endTime));
                echo '&nbsp' . Html::button('<span class="fa fa-calendar"></span> ' . $key, ['data-url' => $url, 'class' => 'fast-daily btn btn-outline-success']);
            }

            $this->view->registerJs('$(\'.fast-daily\').click(function(){window.location.href=$(this).attr(\'data-url\');});');
        }
    }

}