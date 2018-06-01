<?php

namespace SqlChartsDashboard;

class Dashboard {

  public $name = '';

  public $charts = [];

  public function __construct ($name) {
      $this->name = $name;
  }

  public function addChart ($chart) {
    $this->charts [] = $chart;
    return $this;
  }

  public function html () {
    $r = '<h1 class="dashboard-title">'.$this->name.'</h1>';
    for ($i = 0, $n = count  ($this->charts); $i < $n; ++$i){
      $r .= '<div class="dashboard-chart">'.$this->charts[$i]->html().'</div>';
    }
    $r .= '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';
    return $r;
  }

}
