<?php


class Controller404 extends Controller
{

  public function run()
  {
    // TODO: Implement run() method.
    $t = Template::getInstance();
    $t->pageTitle = 'Home';
    include_once TEMPLATES . 'View404.php';
  }
}