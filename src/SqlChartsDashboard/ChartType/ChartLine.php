<?php

namespace SqlChartsDashboard\ChartType;

use SqlChartsDashboard\Chart;

use SqlChartsDashboard\SqlChartsDashboardInterface\ChartTypeInterface;

class ChartLine extends Chart implements ChartTypeInterface {
  public function generate () {
    var_dump($this->query->run());
    return '';
  }
}
