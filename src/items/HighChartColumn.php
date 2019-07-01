<?php

namespace kordar\highcharts\items;

class HighChartColumn extends HighChart
{
    /**
     * @var array
     */
    public $highChartData = [
        'chart' => [
            'type' => 'column'
        ]
    ];

    public function assetsClass()
    {
        // TODO: Implement assetsClass() method.
        return 'kordar\highcharts\assets\LineCharAsset';
    }
}