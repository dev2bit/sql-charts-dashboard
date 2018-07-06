<?php

namespace SqlChartsDashboard\ViewEngine;

use SqlChartsDashboard\SqlChartsDashboardInterface\ViewEngineInterface;

class simple implements ViewEngineInterface {

  public function depends ($dashboard) {
    $depends = [];
    $charts = $dashboard->getCharts();
    for ($i = 0, $n = count  ($charts); $i < $n; ++$i){
      if (!is_array($charts[$i])){
        $charts[$i] = [$charts[$i]];
      }
      for ($j = 0, $m = count($charts[$i]); $j < $m; ++$j){
        if (is_object($charts[$i][$j])){
          $charts_engine = $charts[$i][$j]->getChartsEngine();
          if (!isset($depends[get_class($charts_engine)])){
            $depends [get_class($charts_engine)] = $charts_engine->getDepends();
          }
        }
      }
    }
    $r = '';
    foreach ($depends as $k => $v) {
      $r .= $v;
    }
    return $r;
  }

  public function filters ($dashboard) {
    $filters = $dashboard->getFilters ();
    $r = '<form action="#'.$dashboard->id.'" method="POST">';
    for ($i = 0, $n = count ($filters); $i < $n; ++$i){
      $filters[$i]->postValue();
      $r .= $filters[$i]->html();
    }
    $r .= '<button type="submit">Filtar</button>';
    $r .= '</form>';
    return $r;
  }

  public function html ($dashboard) {
    $r = $this->depends($dashboard);
    $r .= $this->filters ($dashboard);
    $charts = $dashboard->getCharts();
    $r .= '<h1 id="'.$dashboard->id.'" class="dashboard-title">'.$dashboard->getName().'</h1>';
    for ($i = 0, $n = count  ($charts); $i < $n; ++$i){
      if (is_array($charts[$i])){
        $r .= '<div class="row">';
        for ($j = 0, $m = count($charts[$i]); $j < $m; ++$j){
          $r .= '<div class="col">';
          $r .= '<div class="dashboard-chart">';
          $r .= '<h2 class="dashboard-chart-title">'.$charts[$i][$j]->getName().'</h2>';
          $r .= $charts[$i][$j]->generate();
          $r .= '</div>';
          $r .= '</div>';
        }
        $r .= '</div>';
      }
      elseif (is_string($charts[$i])){
        $r .= '<h2 class="dashboard-subtitle">'.$charts[$i].'</h2>';
      }
      else {
        $r .= '<div class="dashboard-chart">';
        $r .= '<h3 class="dashboard-chart-title">'.$charts[$i]->getName().'</h3>';
        $r .= $charts[$i]->generate();
        $r .= '</div>';
      }
    }
    return $r;
  }


}
