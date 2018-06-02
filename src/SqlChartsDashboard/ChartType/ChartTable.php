<?php

namespace SqlChartsDashboard\ChartType;

use SqlChartsDashboard\Chart;

use SqlChartsDashboard\SqlChartsDashboardInterface\ChartTypeInterface;

class ChartTable extends Chart implements ChartTypeInterface {
  public function generate () {
    return $this->engine->chart_table ($this, $this->query->run());
  }
}
