<?php

namespace SqlChartsDashboard\ChartsEngine;

use SqlChartsDashboard\SqlChartsDashboardInterface\ChartsEngineInterface;

class gcharts implements ChartsEngineInterface {

  public function getDepends () {
    return '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';
  }
  
}
