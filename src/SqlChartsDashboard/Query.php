<?php

namespace SqlChartsDashboard;

class Query {

  public $connect = null;
  
  public $sql = null;

  public function __construct ($connect) {
      $this->connect = $connect;
  }

  public function setSQL ($sql) {
    $this->sql = $sql;
    return $this;
  }
  
  public function run () {
    return $this->response = $this->connect->run ($this->sql);
  }

}
