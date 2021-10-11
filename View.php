<?php

class View
{
  private $data = array();

  private $render = FALSE;

  public function __construct($view_name, $data = array())
  {
      try {
          $file = ROOT . '/views/' . $view_name . '.php';

          if (file_exists($file)) {
            include $file;
          } else {
            //only for dev purpose
            echo $file . ' Not exists';
          }
      }
      catch (Error $e) {
          echo $e;
      }
  }

  public function assign($variable, $value)
  {
      $this->data[$variable] = $value;
  }

}