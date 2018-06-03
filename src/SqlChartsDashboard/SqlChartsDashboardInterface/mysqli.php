<?php

namespace SqlChartsDashboard\SqlEngine;

use SqlChartsDashboard\SqlChartsDashboardInterface\SqlEngineInterface;


class mysqli implements SqlEngineInterface {

  private $connection = null;

  public  function __construct ($db, $user, $pass, $host = 'localhost') {
    $this->connection = new \mysqli($host, $user, $pass, $db);
    if ($this->connection->connect_errno) {
      // TODO: exception
      echo "Falló la conexión con MySQL: (" . $this->connection->connect_errno . ") " . $this->connection->connect_error;
    }
  }

  public function run ($query) {
    $result = $this->connection->query ($query);
    $r =  [];
    if ($result) {
      for ($i = 0, $n = $result->num_rows; $i < $n;++$i) {
          $result->data_seek($i);
          $r[] = $result->fetch_assoc();
      }
    }
    return $r;
  }


}
