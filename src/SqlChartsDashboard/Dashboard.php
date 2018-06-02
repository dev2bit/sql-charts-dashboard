<?php

namespace SqlChartsDashboard;

class Dashboard {

  private $name = '';

  private $charts = [];

  private $view = null;

  private static $default_connection = null;

  private static $default_view_engine = 'simple';

  private static $default_sql_engine = 'mysqli';

  private static $default_charts_engine = 'google_charts';

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


  public function __construct ($name, $view = null) {
      $this->name = $name;
      if (!$view) {
        $view = static::getDefaultViewEngine();
      }
      if (is_string($view)) {
        $class_view =  '\\SqlChartsDashboard\ViewEngine\\'.$view;
        if (class_exists ($class_view)) {
          $this->view = new $class_view ();
        }else {
          //TODO: Exception
          echo "Error no view engine";
        }
      }else if (is_object ($view)) {
        $this->view = $view;
      }
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
