<?php

namespace SqlChartsDashboard;

class Connection {

  public $db = null;

  public function __construct ($db, $user, $pass, $host = 'localhost', $engine = null) {
    if (!$engine) {
      $engine = Dashboard::getDefaultSqlEngine ();
    }
    if (is_string ($engine)) {
      $class_engine = '\\SqlChartsDashboard\SqlEngine\\'.$engine;
      if (class_exists ($class_engine)) {
        $this->db = new $class_engine ($db, $user, $pass, $host);
      }else {
        //TODO: Exception
        echo "Error no SQL engine";
      }
    }else if (is_object($engine)) {
      $this->db = $engine;
    }
  }

  public function run ($query) {
    if ($this->db) {
      return $this->db->run ($query);
    }
  }

}
