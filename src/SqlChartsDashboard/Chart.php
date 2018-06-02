<?php

namespace SqlChartsDashboard;

abstract class Chart {

  public $name = '';

  public $query = null;

  public $engine = null;

  public $columns = null;

  public $options = null;

  public function __construct ($name, $query = null, $engine = null) {
      $this->name = $name;
      $this->query = $query;
      if (!$engine) $engine = Dashboard::getDefaultChartsEngine();
      $this->setChartsEngine($engine);
  }

  public function setChartsEngine ($engine) {
    if (is_string($engine)) {
      $class_engine =  '\\SqlChartsDashboard\ChartsEngine\\'.$engine;
      if (class_exists ($class_engine)) {
        $this->engine = new $class_engine ();
      }else {
        //TODO: Exception
        echo "Error no chart engine";
      }
    }else if (is_object ($engine)) {
      $this->engine = $engine;
    }
  }

  public function getChartsEngine () {
    return $this->engine;
  }

  public function getName () {
    return $this->name;
  }

  public function setColumns ($columns) {
    $this->columns = $columns;
    return $this;
  }

  public function getColumns (){
    return $this->columns;
  }

  public function setOptions ($options) {
    $this->options = $options;
    return $this;
  }

  public function getOptions () {
    return $this->options;
  }

  public function setQuery ($query, $connection = null) {
    if (is_string ($query)) {
      $this->query = new Query ($query, $connection);
    }else {
      $this->query = $query;
    }
    return $this;
  }

  abstract public function generate ();

}
