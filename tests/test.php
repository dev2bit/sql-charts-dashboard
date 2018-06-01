<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SqlChartsDashboard\Dashboard;
use SqlChartsDashboard\Chart;
use SqlChartsDashboard\Query;
use SqlChartsDashboard\Connect;

$c = new Connect ('biduzz', 'biduzz', 'biduzz', '172.18.0.5');

echo (
    new Dashboard ('example')
)->addChart (
  (
    new Chart (
      'chart-example'
    )
  )->setQuery (
    (
      new Query ($c)
    )->setSQL("SELECT * FROM bookings")
  )
)->html ();
