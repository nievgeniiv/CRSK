<?php


class ControllerContacts extends Controller
{

  public function run()
  {
    // TODO: Implement run() method.
    $t = Template::getInstance();
    $t->pageTitle = 'Контакты';
    $db = new ModelPage();
    $t->dataInput = $db->getData('contacts');
    include_once TEMPLATES . 'ViewContacts.php';
  }
}