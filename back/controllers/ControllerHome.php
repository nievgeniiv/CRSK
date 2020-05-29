<?php


class ControllerHome extends Controller
{

  public function run()
  {
    // TODO: Implement run() method.
    if (count($this->url) < 1) {
      $this->actView();
      return;
    }
    $this->act404();
  }

  private function actView()
  {
    $db = new ModelNews();
    $t = Template::getInstance();
    $t->dataInput = $db->getLastData(3);
    $t->pageTitle = 'Home';
    include_once TEMPLATES . 'ViewHome.php';
  }
}