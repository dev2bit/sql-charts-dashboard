<?php

namespace SqlChartsDashboard\SqlChartsDashboardInterface;

interface SqlEngineInterface {

  public function __construct ($db, $user, $pass, $host = 'localhost');

  public function run ($query);

}
