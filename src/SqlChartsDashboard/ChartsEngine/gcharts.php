<?php

namespace SqlChartsDashboard\ChartsEngine;

use SqlChartsDashboard\SqlChartsDashboardInterface\ChartsEngineInterface;

class gcharts implements ChartsEngineInterface {

  public function getDepends () {
    return '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';
  }

  public function load ($type) {
    return "google.charts.load('current', {'packages':['".$type."']});";
  }

  public function generate_id ($chart) {
    return 'chart_'.spl_object_hash ($chart);
  }

  public function data ($chart, $data){
    $r = 'var data = new google.visualization.DataTable();';
    $columns = $chart->getColumns ();
    foreach ($columns as $k => $v) {
      $r .= "data.addColumn('".$v['type']."', '".$v['label']."');";
    }
    $r .= 'data.addRows([';
    for ($i = 0, $n = count ($data); $i < $n; ++$i) {
      $r .= '[';
      foreach ($columns as $k => $v) {
        $r .= (($v['type'] == 'string')?"'":"").$data[$i][$k].(($v['type'] == 'string')?"'":"").",";
      }
      $r .= '],';
    }
    $r .= ']);';
    return $r;
  }

  public function options ($chart) {
    if ($options = $chart->getOptions()) {
      return "var options = ".json_encode ($options).";";
    }
    return '';
  }

  public function chart_general ($chart, $data, $type, $load = 'corechart') {
    $chart_id = $this->generate_id ($chart);
    $r = '<div id="chart_container_'.$chart_id.'"></div>';
    $r .= '<script type="text/javascript">';
    $r .= $this->load ($load);
    $r .= 'google.charts.setOnLoadCallback('.$chart_id.');';
    $r .= 'function '.$chart_id. ' () {';
    $r .= $this->data ($chart, $data);
    $r .= "var chart = new google.visualization.".$type."(document.getElementById('chart_container_".$chart_id."'));";
    if ($options = $this->options($chart)) {
      $r .= $options;
      $r .= "chart.draw(data, options);";
    }else {
      $r .= "chart.draw(data);";
    }

    $r .= '}';
    $r .= '</script>';
    return $r;
  }

  public function chart_line ($chart, $data) {
    return $this->chart_general ($chart, $data, 'LineChart');
  }

  public function chart_bar ($chart, $data) {
    return $this->chart_general ($chart, $data, 'BarChart');
  }

  public function chart_pie ($chart, $data) {
    return $this->chart_general ($chart, $data, 'PieChart');
  }

  public function chart_area ($chart, $data) {
    return $this->chart_general ($chart, $data, 'SteppedAreaChart');
  }

  public function chart_table ($chart, $data) {
    return $this->chart_general ($chart, $data, 'Table', 'table');
  }

  public function chart_simple ($chart, $data) {
    $chart_id = $this->generate_id ($chart);
    $options = $chart->getOptions();
    $columns = $chart->getColumns ();
    $r = '<div id="chart_container_'.$chart_id.'">';
    $r .= '<p class="chart_single_container">';
    if ($columns) {
      $key = array_keys($columns)[0];
      $val = $data[0][$key];
    }else {
      $val = reset($data[0]);
    }
    $r .= '<span class="chart_single_value" style="font-size:6em">'.
      ((is_numeric($val))?number_format($val, (isset($options['decimals']) && is_numeric($options['decimals']))?$options['decimals']:2):$val).
    '</span>';
    if (isset($options['unit']) && is_string($options['unit'])) {
      $r .= ' <span class="chart_single_unit" style="font-size:2em">'.$options['unit'].'</span>';
    }
    $r .= '</div>';
    return $r;
  }

}
