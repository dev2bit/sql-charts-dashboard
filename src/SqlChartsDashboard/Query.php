<?php

namespace SqlChartsDashboard;

class Query {

  private $connection = null;

  private $sql = null;

  private $response = null;

  private $filters = null;

  static private $default_connection = null;

  public function __construct ($sql = null, $connection = null) {
      $this->sql = $sql;
      if (!$connection){
        if ($c = Dashboard::getDefaultConnection ()) {
            $this->connection = $c;
        }else{
          // TODO: exception
          echo "Falló sin conexión ha base de datos por defecto";
        }
      }else {
        $this->connection = $connection;
      }
  }

  public function setConnection ($connect) {
    $this->connection = $connection;
    return $this;
  }

  public function setSQL ($sql) {
    $this->sql = $sql;
    return $this;
  }

  public function setFilters ($filters) {
    $this->filters = $filters;
  }

  public function filters ($sql) {
    $f = "";
    if ($this->filters) {
      for ($i = 0, $n = count ($this->filters); $i < $n; ++$i) {
        $this->filters[$i]->postValue();
        if ($exp = $this->filters[$i]->run()){
          $f .=  $exp." AND ";
        }
      }
    }
    $f .= "1 = 1";
    return str_replace("%filters%", $f, $sql);
  }

  public function run () {
    if (!$this->response){
      $sql = $this->sql;
      if ($this->filters){
        $sql = $this->filters($sql);
      }
      return $this->response = $this->connection->run ($sql);
    }
    else
      return $this->response;
  }

}
