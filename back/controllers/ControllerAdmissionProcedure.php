<?php


class ControllerAdmissionProcedure extends Controller
{

  public function run()
  {
    // TODO: Implement run() method.
    $t = Template::getInstance();
    $t->pageTitle = 'Порядок зачисления';
    include_once TEMPLATES . 'ViewAdmissionProcedure.php';
  }
}