<?php

namespace SqlChartsDashboard\SqlChartsDashboardInterface;

interface ChartTypeInterface {

  public function __construct ($name, $query = null, $engine = null);

  public function setChartsEngine ($engine);

  public function getChartsEngine ();

  public function getName ();

  public function setColumns ($columns);

  public function getColumns ();

  public function setQuery ($query, $connection = null);

  public function generate ();

}
