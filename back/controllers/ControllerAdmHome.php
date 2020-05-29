<?php


class ControllerAdmHome extends Controller
{

  public function run()
  {
    // TODO: Implement run() method.

    $form = new ServiceLogin('login');
    if ($ok = $form->checkInput() === true) {
      $t = Template::getInstance();
      $t->page = 'Admin';
      $t->pageTitle = 'Admin Home';
      include_once TEMPLATES . 'ViewAdmHome.php';
    } else {
      redirect('/adm/');
    }
  }
}