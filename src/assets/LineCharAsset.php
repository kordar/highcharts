<?php

namespace kordar\highcharts\assets;

class LineCharAsset extends HighChartAsset
{
    public $js = [
        'code/highcharts.js',
        'code/modules/series-label.js',
        'code/modules/exporting.js',
        'code/modules/export-data.js',
    ];

    public $depends = [
//        '\kordar\hchart\assets\SeriesLabelAsset',
//        '\kordar\hchart\assets\ExportAsset',
    ];
}