<?php

namespace SqlChartsDashboard;

class Query {

  private $connection = null;

  private $sql = null;

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

  public function run () {
    return $this->response = $this->connection->run ($this->sql);
  }

}
