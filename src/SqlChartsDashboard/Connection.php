<?php

namespace SqlChartsDashboard;

class Connection {

  public $db = null;

  public function __construct ($db, $user, $pass, $host = 'localhost', $engine = null) {
    if (!$engine) {
      $engine = Dashboard::getDefaultSqlEngine ();
    }
    $class_engine = '\\SqlChartsDashboard\SqlEngine\\'.$engine;
    $this->db = new $class_engine ($db, $user, $pass, $host);
  }

  public function run ($query) {
    if ($this->db) {
      return $this->db->run ($query);
    }
  }

}
