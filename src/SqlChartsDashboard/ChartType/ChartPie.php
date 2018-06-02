<?php

namespace SqlChartsDashboard\ChartType;

use SqlChartsDashboard\Chart;

use SqlChartsDashboard\SqlChartsDashboardInterface\ChartTypeInterface;

class ChartPie extends Chart implements ChartTypeInterface {
  public function generate () {
    return $this->engine->chart_pie ($this, $this->query->run());
  }
}
