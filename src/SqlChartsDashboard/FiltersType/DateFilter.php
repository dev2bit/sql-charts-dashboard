<?php

namespace SqlChartsDashboard\FiltersType;

use SqlChartsDashboard\Filter;

class DateFilter extends Filter {
  public function html () {
    return '<input type="date" '.$this->attrs().' >';
  }
}

 ?>
