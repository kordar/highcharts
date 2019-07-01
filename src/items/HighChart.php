<?php

namespace kordar\highcharts\items;

use yii\helpers\ArrayHelper;

abstract class HighChart
{
    /**
     * @var array
     */
    public $data = [];

    /**
     * @var array
     */
    public $highChartData = [];

    /**
     * @var array
     */
    public $categories = [];

    /**
     * @return string
     */
    abstract public function assetsClass();

    protected function title($sign, $default = '')
    {
        $title = ArrayHelper::getValue($this->data, $sign, $default);

        if (is_string($title)) {
            return ['text' => $title];
        }

        return '';
    }

    /**
     * @param $title
     * @param $subTitle
     */
    public function generateTitle($title, $subTitle)
    {
        $this->highChartData['title'] = $this->title($title);
        if ($subTitle === 'betweenCategories' && !empty($this->categories)) {
            $subTitle = min($this->categories) . '~' . max($this->categories);
        }
        $this->highChartData['subtitle'] = $this->title($subTitle);
    }

    /**
     * @param $series
     */
    public function generateSeries($series)
    {
        $this->highChartData['series'] = array_map(function ($column) {

            $key = $column['attribute'];
            $column['data'] = $this->data[$key];
            unset($column['attribute'], $column['value']);
            return $column;

        }, $series);
    }

    /**
     * @param $yAxisTitle
     */
    public function generateAxis($yAxisTitle)
    {
        if ($yAxisTitle !== null) {
            $this->highChartData['yAxis']['title'] = $this->title($yAxisTitle);
        }

        $this->highChartData['xAxis']['categories'] = $this->categories;
    }

    /**
     * @param $legendDefault
     * @param $legend
     */
    public function generateLegend($legendDefault, $legend)
    {
        $this->highChartData['legend'] = ArrayHelper::merge($legendDefault, $legend);
    }
}