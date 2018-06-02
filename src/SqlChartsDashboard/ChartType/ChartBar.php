<?php

namespace SqlChartsDashboard\ChartType;

use SqlChartsDashboard\Chart;

use SqlChartsDashboard\SqlChartsDashboardInterface\ChartTypeInterface;

class ChartBar extends Chart implements ChartTypeInterface {
  public function generate () {
    return $this->engine->chart_bar ($this, $this->query->run());
  }
}
