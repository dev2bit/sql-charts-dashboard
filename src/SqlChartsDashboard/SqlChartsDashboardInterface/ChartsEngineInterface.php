<?php

namespace SqlChartsDashboard\SqlChartsDashboardInterface;

interface ChartsEngineInterface {

  public function getDepends ();

  public function chart_line ($chart, $data);
  
  public function chart_bar ($chart, $data);

}
