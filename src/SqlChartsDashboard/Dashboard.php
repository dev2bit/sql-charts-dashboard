<?php

namespace SqlChartsDashboard;

class Dashboard {

  private $name = '';

  private $charts = [];

  private static $default_connection = null;

  private static $default_sql_engine = 'mysqli';

  private static $default_charts_engine = 'google_charts';

  public function __construct ($name) {
      $this->name = $name;
  }

  static public function setDefaultConnection ($connection, $user = null, $pass = null, $host = 'localhost', $engine = null) {
    if (is_object ($connection)) {
      static::$default_connection = $connection;
    }
    else {
      if (!$engine) {
        $engine = static::getDefaultSqlEngine();
      }
      static::$default_connection = new Connection ($connection, $user, $pass, $host, $engine);
    }
  }

  static public function getDefaultConnection () {
    return static::$default_connection;
  }

  static public function setDefaultSqlEngine ($engine) {
      static::$default_sql_engine = $engine;
  }

  static public function getDefaultSqlEngine () {
      return static::$default_sql_engine;
  }

  static public function setDefaultChartsEngine ($engine) {
      static::$default_charts_engine = $engine;
  }

  static public function getDefaultChartsEngine () {
      return static::$default_charts_engine;
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
