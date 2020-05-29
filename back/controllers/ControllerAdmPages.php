<?php


class ControllerAdmPages extends Controller
{

  public function run()
  {
    // TODO: Implement run() method.

    $form = new ServiceLogin('login');
    if ($ok = $form->checkInput() === true) {
      $t = Template::getInstance();
      $t->page = 'Admin';
      switch ($this->url[2]) {
        case 'view':
          $this->actView();
          return;
        case 'save':
          $this->actSave();
          return;
        case 'error':
          $this->actError();
          break;
      }
      $this->act404();
      return;
    } else {
      redirect('/adm/');
    }
  }

  private function actView()
  {
    $t = Template::getInstance();
    $db = new ModelPage();
    $t->get = $_GET['page'];
    switch ($_GET['page']) {
      case 'about':
        $t->pageTitle = 'Изменение содержания страницы "О ЦРСК"';
        $t->dataInput = $db->getData($_GET['page']);
        break;
      case 'admissionProcedure':
        $t->pageTitle = 'Изменение содержания страницы "Порядок зачисления"';
        $t->dataInput = $db->getData($_GET['page']);
        break;
      case 'applicationEducation':
        $t->pageTitle = 'Изменение содержания страницы "Подать заявку на обучение"';
        $t->dataInput = $db->getData($_GET['page']);
        break;
      case 'organizationInformation':
        $t->pageTitle = 'Изменение содержания страницы "Сведения об организации"';
        $t->dataInput = $db->getData($_GET['page']);
        break;
      case 'contacts':
        $t->pageTitle = 'Изменение содержания страницы "Контакты"';
        $t->dataInput = $db->getData($_GET['page']);
        break;
    }
    include_once TEMPLATES . 'ViewAdmPages.php';
  }

  private function actSave()
  {
    $db = new ModelPage();
    $ok = $db->saveData($_GET['page'], $_POST['data']);
    if ($ok === true) {
      redirect('/adm/home');
    } else {
      redirect('/adm/pages/error');
    }
  }

  private function actError()
  {
    $t = Template::getInstance();
    $t->pageTitle = 'Произошла непредвиденная ошибка. Обратитесь к разработчику сайта';
    include_once TEMPLATES . 'ViewAdmError.php';
  }
}