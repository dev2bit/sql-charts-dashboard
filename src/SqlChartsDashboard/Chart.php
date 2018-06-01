<?php

namespace SqlChartsDashboard;

class Chart {

  public $name = '';

  public $query = null;

  public function __construct ($name, $query = null) {
      $this->name = $name;
      $this->query = $query;
  }

  public function setQuery ($query) {
    $this->query = $query;
    return $this;
  }

  public function html () {
    $r = '<h2 class="dashboard-chart-title">'.$this->name.'</h2>';
    return $r;
  }

}
