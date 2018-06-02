<?php

namespace SqlChartsDashboard\SqlEngine;

use SqlChartsDashboard\SqlEngine;

class pdomysql implements SqlEngine {

  private $connection = null;

  public  function __construct ($db, $user, $pass, $host = 'localhost') {
    try{
      $this->connection = new \PDO('mysql:host='.$host.';dbname='.$db, $user, $pass);
    }catch(PDOException $e){
      // TODO: exception
      echo "Falló la conexión con MySQL:" . $e->getMessage();
    }
  }

  public function run ($query) {
    $result = $this->connection->query ($query);
    $r =  [];
    foreach ($result as $row) {
        $r [] = $row;
    }
    return $r;
  }


}
