<?php

namespace kordar\highcharts\items;

class HighChartPie extends HighChart
{
    /**
     * @var array
     */
    public $highChartData = [
        'chart' => [
            'plotBackgroundColor' => null,
            'plotBorderWidth' => null,
            'plotShadow' => false,
            'type' => 'pie'
        ],
        'tooltip' => [
            'pointFormat' => '{series.name}: <b>{point.y}</b>'
        ],
        'plotOptions' => [
            'pie' => [
                'allowPointSelect' => true,
                'cursor' => 'pointer',
                'dataLabels' => [
                    'enabled' => true,
                    'format' => '<b>{point.name}</b>: {point.y}',
                    'style' => [
                        'color' => 'black'
                    ]
                ]
            ]
        ]
    ];

    public function assetsClass()
    {
        // TODO: Implement assetsClass() method.
        return 'kordar\highcharts\assets\LineCharAsset';
    }

    public function generateSeries($series)
    {
        $this->highChartData['series'] = array_map(function ($column) {

            $name = $column['attribute'];
            $column['data'] = $this->data[$name];
            unset($column['attribute'], $column['value']);
            return $column;

        }, $series);
    }
}