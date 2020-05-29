<?php


class ControllerAdmLogin extends Controller
{

  public function run()
  {
    // TODO: Implement run() method.
    if (count($this->url) < 2) {
      $this->actView();
      return;
    }
    switch ($this->url[1]){
      case 'do':
        $this->actLogin();
        return;
      case 'out':
        $this->actLogout();
        return;
    }
    $this->act404();
  }

  private function actView()
  {
    $t = Template::getInstance();
    $form = new ServiceLogin('loginCRSK');
    if ($ok = $form->checkInput() === true) {
      redirect('/adm/home/');
    } else {
      $t->pageTitle = 'Введите логин и пароль';
      $form = new ServiceLogin('login');
      $form->readData();
      if ($form->isError() === true) {
        $t->loginData = $form->getData();
        $t->loginError = $form->getErrors();
      }
      $t->pageTitle = 'Вход';
      include_once TEMPLATES . 'login/index.php';
    }
  }

  private function actLogin()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $form = new ServiceLogin('loginCRSK');
      $form->readData();
      $db = new ModelLogin();
      $data = $db->checkLogin($_POST['username'], $_POST['passwd']);
      $form->checkLogin($data['login']);
      $form->checkPasswd($data['passwd']);
      if ($form->isError() === true) {
        $form->saveData();
        writeFile('auth','Была попытка авторизации под пользователем '.$_POST['username'].' с адреса '.
          $_SERVER['REMOTE_ADDR']);
        redirect('/adm');
      } else {
        $form->saveHash($data['id']);
        $form->clear();
        writeFile('auth','Прошла авторизация под пользователем '.$_POST['username'].' с адреса '.
                    $_SERVER['REMOTE_ADDR']);
        redirect('/adm/home/');
      }
    }
  }

  private function actLogout()
  {
    $form = new ServiceLogin('loginCRSK');
    $form->logOut();
    writeFile('auth', 'Пользователь '.$_POST['username'].' разлогинился');
    redirect('/adm/');
  }
}
