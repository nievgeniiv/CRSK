<?php


class ControllerChildrenUniversity extends Controller
{

  public function run()
  {
    // TODO: Implement run() method.
    if (count($this->url) < 2) {
      $this->actView();
      return;
    }
    $this->act404();
  }

  private function actView()
  {
    $t = Template::getInstance();
    $db = new ModelChildrenUniversity();
    $t->dataInput = $db->getData();
    $t->pageTitle = 'Образовательные программы';
    include_once TEMPLATES . 'ViewChildrenUniversity.php';
  }
}