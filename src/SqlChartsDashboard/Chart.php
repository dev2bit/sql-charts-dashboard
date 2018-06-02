<?php

namespace SqlChartsDashboard;

class Chart {

  public $name = '';

  public $query = null;

  public $engine = null;

  public function __construct ($name, $query = null, $charts_engine = null) {
      $this->name = $name;
      $this->query = $query;
      if (!$charts_engine) {
        $charts_engine = Dashboard::getDefaultChartsEngine();
      }
      if (is_string($charts_engine)) {
        $class_engine =  '\\SqlChartsDashboard\ChartsEngine\\'.$charts_engine;
        if (class_exists ($class_engine)) {
          $this->engine = new $class_engine ();
        }else {
          //TODO: Exception
          echo "Error no chart engine";
        }
      }else if (is_object ($charts_engine)) {
        $this->engine = $charts_engine;
      }
  }

  public function getChartsEngine () {
    return $this->engine;
  }

  public function setQuery ($query, $connection = null) {
    if (is_string ($query)) {
      $this->query = new Query ($query, $connection);
    }else {
      $this->query = $query;
    }
    return $this;
  }

  public function html () {
    $r = '<h2 class="dashboard-chart-title">'.$this->name.'</h2>';
    var_dump($this->query->run());
    return $r;
  }

}
