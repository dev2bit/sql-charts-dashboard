<?php

namespace SqlChartsDashboard\ChartType;

use SqlChartsDashboard\Chart;

use SqlChartsDashboard\SqlChartsDashboardInterface\ChartTypeInterface;

class ChartArea extends Chart implements ChartTypeInterface {
  public function generate () {
    return $this->engine->chart_area ($this, $this->query->run());
  }
}
