<?php


class ControllerAdmEvents extends Controller
{

  public function run()
  {
    // TODO: Implement run() method.

    $form = new ServiceLogin('login');
    if ($ok = $form->checkInput() === true) {
      $t = Template::getInstance();
      $t->page = 'Admin';
      include_once TEMPLATES . 'ViewAdmHome.php';
    } else {
      redirect('/adm/');
    }
  }
}