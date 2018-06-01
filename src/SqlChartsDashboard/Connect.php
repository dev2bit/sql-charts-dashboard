<?php

namespace SqlChartsDashboard;

class Connect {

  public $mysql = null;

  public function __construct ($db, $user, $pass, $host = 'localhost') {
      $this->mysql = new mysqli($hosts, $user, $pass, $db);
  }

  public function run ($query) {
    return $this->mysql->query ($query);
  }

}
