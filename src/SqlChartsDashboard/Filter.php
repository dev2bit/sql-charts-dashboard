<?php

namespace SqlChartsDashboard;

abstract class Filter {
  static public $ids = 0;

  private $id = null;
  private $label = null;
  private $field = null;
  private $operator = null;
  private $value = null;

  private $form = null;

  public function __construct ($label, $config, $operator = null) {
    $this->id = ++Filter::$ids;
    $this->operator = (($operator)?$operator:$config['operator']);
    $this->field = ((!is_array($config))?$config:$config['field']);
    $this->label = $label;
  }

  public function setForm ($form)  {
    $this->form = $form;
  }

  public function postValue () {
    if (!$this->value) {
      if (isset ($_POST[$this->form][$this->id])){
        $this->value = $_POST[$this->form][$this->id];
      }
    }
  }

  public function name () {
    return " name=\"".$this->form."[".$this->id."]\" ";
  }

  public function value () {
    return " value=\"".(($this->value)?$this->value:"")."\" ";
  }

  public function attrs () {
    return $this->name().$this->value();
  }


  public function run () {
    if ($this->value) {
      return "(".$this->field." ".$this->operator." '".$this->value."')";
    }
    return null;
  }
  abstract public function html ();
}
 ?>
