<?php

namespace SqlChartsDashboard\ViewEngine;

use SqlChartsDashboard\SqlChartsDashboardInterface\ViewEngineInterface;

class simple implements ViewEngineInterface {

  public function html ($dashboard) {
    $r = '<h1 class="dashboard-title">'.$dashboard->getName().'</h1>';
    $charts = $dashboard->getCharts();
    $depends = [];
    for ($i = 0, $n = count  ($charts); $i < $n; ++$i){
      $charts_engine = $charts[$i]->getChartsEngine();
      if (!isset($depends[get_class($charts_engine)])){
        $depends [get_class($charts_engine)] = $charts_engine->getDepends();
      }
      $r .= '<div class="dashboard-chart">'.$charts[$i]->html().'</div>';
    }
    foreach ($depends as $k => $v) {
      $r .= $v;
    }
    return $r;
  }


}
