<?php


class ControllerOrganizationInformation extends Controller
{

  public function run()
  {
    // TODO: Implement run() method.
    $t = Template::getInstance();
    $t->pageTitle = 'Сведения об организации';
    include_once TEMPLATES . 'ViewOrganizationInformation.php';
  }
}