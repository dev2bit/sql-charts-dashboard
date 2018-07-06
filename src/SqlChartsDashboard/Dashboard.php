<?php

namespace SqlChartsDashboard;

class Dashboard {

  private $name = '';

  private $charts = [];

  private $filters = [];

  private $view = null;

  private $id = null;

  private static $ids = 0;

  private static $default_connection = null;

  private static $default_view_engine = 'simple';

  private static $default_sql_engine = 'mysqli';

  private static $default_charts_engine = 'gcharts';

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

  static public function setDefaultViewEngine ($engine) {
    static::$default_view_engine = $engine;
  }

  static public function getDefaultViewEngine () {
    return static::$default_view_engine;
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

  public function __construct ($name, $charts = [], $filters = [], $view = null) {
      $this->id = ++Dashboard::$ids;
      $this->name = $name;
      if (!is_array($charts)) $charts = [$charts];
      $this->charts = $charts;
      $this->filters = $filters;
      if (!$view) $view = static::getDefaultViewEngine();
      $this->setViewEngine($view);
      if (is_array($filters)){
        for ($i = 0, $n = count ($filters); $i < $n; ++$i) {
          $filters[$i]->setForm($this->id);
        }
      }
      $this->processCharts($this->charts);
  }

  public function processCharts ($charts) {
    if (is_array ($charts)) {
      for ($i = 0, $n = count($charts); $i < $n; ++$i) {
        if (is_object($charts[$i])){
          $charts[$i]->setFilters($this->filters);
        }
        elseif (is_array($charts[$i])){
          $this->processCharts($charts[$i]);
        }
      }
    }
  }

  public function getFilters () {
    return $this->filters;
  }

  public function setViewEngine ($engine) {
    if (is_string($engine)) {
      $class_view =  '\\SqlChartsDashboard\ViewEngine\\'.$engine;
      if (class_exists ($class_view)) {
        $this->view = new $class_view ();
      }else {
        //TODO: Exception
        echo "Error no view engine";
      }
    }else if (is_object ($engine)) {
      $this->view = $engine;
    }
  }

  public function getViewEngine () {
    return $view;
  }

  public function getName () {
    return $this->name;
  }

  public function getCharts () {
    return $this->charts;
  }

  public function addChart ($chart) {
    $this->charts [] = $chart;
    return $this;
  }

  public function html () {
    return $this->view->html ($this);
  }

}
