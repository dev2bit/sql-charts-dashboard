<?php

namespace SqlChartsDashboard;

class Chart {

  public $name = '';

  public $query = null;

  public function __construct ($name, $query = null) {
      $this->name = $name;
      $this->query = $query;
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
