<?php


abstract class Controller {

  protected $url;

  public function __construct(array $url) {
    $this->url = $url;
  }

  abstract public function run();

  public function act404() {
    include_once TEMPLATES . 'View404.php';
  }

}