<?php

namespace SqlChartsDashboard\ViewEngine;

use SqlChartsDashboard\SqlChartsDashboardInterface\ViewEngineInterface;

class simple implements ViewEngineInterface {

  public function html ($dashboard) {
    $r = '<h1 class="dashboard-title">'.$dashboard->getName().'</h1>';
    $charts = $dashboard->getCharts();
    for ($i = 0, $n = count  ($charts); $i < $n; ++$i){
      $r .= '<div class="dashboard-chart">'.$charts[$i]->html().'</div>';
    }
    $r .= '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';
    return $r;
  }


}
