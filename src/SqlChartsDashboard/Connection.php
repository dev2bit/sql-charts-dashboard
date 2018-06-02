<?php

namespace SqlChartsDashboard;

class Connection {

  private $db = null;

  public function __construct ($db, $user, $pass, $host = 'localhost', $engine = null) {
    if (!$engine) $engine = Dashboard::getDefaultSqlEngine ();
    $this->setSqlEngine($engine, $db, $user, $pass, $host);
  }

  public function setSqlEngine ($engine, $db = null, $user = null, $pass = null, $host = 'localhost'){
    if (is_string ($engine)) {
      $class_engine = '\\SqlChartsDashboard\SqlEngine\\'.$engine;
      if (class_exists ($class_engine)) {
        if ($db && $user && $pass && $host) {
          $this->db = new $class_engine ($db, $user, $pass, $host);
        }else {
          //TODO: Exception
          echo "Error no SQL Connection data";
        }
      }else {
        //TODO: Exception
        echo "Error no SQL engine";
      }
    }else if (is_object($engine)) {
      $this->db = $engine;
    }
  }

  public function getSqlEngine () {
    return $this->db;
  }

  public function run ($query) {
    if ($this->db) {
      return $this->db->run ($query);
    }
  }

}
