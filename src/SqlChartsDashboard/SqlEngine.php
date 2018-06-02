<?php

namespace SqlChartsDashboard;

interface SqlEngine {

  public function __construct ($db, $user, $pass, $host = 'localhost');

  public function run ($query);

}
