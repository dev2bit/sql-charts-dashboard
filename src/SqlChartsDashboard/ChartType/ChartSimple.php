<?php

namespace SqlChartsDashboard\ChartType;

use SqlChartsDashboard\Chart;

use SqlChartsDashboard\SqlChartsDashboardInterface\ChartTypeInterface;

class ChartSimple extends Chart implements ChartTypeInterface {
  public function generate () {
    return $this->engine->chart_simple ($this, $this->query->run());
  }
}
