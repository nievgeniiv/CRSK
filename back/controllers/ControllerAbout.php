<?php


class ControllerAbout extends Controller
{

  public function run()
  {
    if (count($this->url) < 2) {
      $this->actView();
      return;
    }
    $this->act404();
  }

  private function actView()
  {
    $db = new ModelAbout();
    $t = Template::getInstance();
    $t->dataInput = $db->getData()[0];
    $t->pageTitle = 'О ЦРСК';
    include_once TEMPLATES . 'ViewAbout.php';
  }
}