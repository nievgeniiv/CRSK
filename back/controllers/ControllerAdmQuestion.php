<?php


class ControllerAdmQuestion extends Controller
{

  public function run()
  {
    $form = new ServiceLogin('login');
    if ($ok = $form->checkInput() === true) {
      $t = Template::getInstance();
      $t->page = 'Admin';
      if (count($this->url) > 4) {
        $this->act404();
        return;
      }
      switch ($this->url[2]) {
        case '':
          $this->actList();
          return;
        case 'view':
          $this->actView();
          return;
        case 'save':
          $this->actSave();
          return;
        case 'updateFAQ':
          $this->actUpdateFAQ();
          return;
        case 'delete':
          $this->actDelete();
          return;
      }
      $this->act404();
    } else {
      redirect('/adm/');
    }
  }

  private function actList()
  {
    $t = Template::getInstance();
    $page = $_GET['page'] ?? 1;
    $nofInPage = 10;
    $t->pageTitle = 'Вопрос/ответ';
    $db = new ModelQuestion();
    $t->data = $db->getDataForAdmin($page, $nofInPage);
    if (isset($_SESSION['questionComplite']) and $_SESSION['questionComplite'] === true) {
      $t->questionComplite = 'Ответ отправлен';
      unset($_SESSION['questionComplite']);
    }
    include_once TEMPLATES . 'ViewAdmQuestion.php';
  }

  private function actView()
  {
    //TODO: Write pagination
    if (!isset($_GET['id']) or $_GET['id'] === '') {
      redirect('/adm/question');
    }
    $id = $_GET['id'];
    $t = Template::getInstance();
    $form = new ServiceForm('FAQ');
    $form->readData();
    if ($form->isError() === true) {
      $t->errors = $form->getErrors();
      $t->data = $form->getData();
    }
    $t->pageTitle = 'Вопрос/ответ';
    $db = new ModelQuestion();
    $t->data = $db->getOne($id);
    if (isset($_SESSION['questionComplite']) and $_SESSION['questionComplite'] === true) {
      $t->questionComplite = 'Ответ отправлен';
      unset($_SESSION['questionComplite']);
    }
    include_once TEMPLATES . 'ViewAdmQuestionEdit.php';
  }

  private function actSave()
  {
    $id = $_GET['id'];
    $url = '/adm/question';
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      redirect($url);
    }
    $form = new ServiceForm('FAQ');
    $form->readData();
    $this->inputData($form);
    if ($form->isError() === true) {
      $form->saveData();
      redirect('/question/view/?id='.$id);
    }
    $data = $form->getData();
    $db = new ModelQuestion();
    $ok = $db->updateQuestion($id, $data);
    if ($ok === false) {
      $str = __METHOD__ . ' Ошибка записи данных в БД.';
      writeFile('dbLog', $str);
      $form->setValue('errorDB', $str);
      redirect($url);
    }
    $form->clear();
    $_SESSION['questionComplite'] = true;
    redirect($url);
  }

  private function inputData(ServiceForm $form)
  {
    $form->checkField('answer', '', true);
  }

  private function actUpdateFAQ()
  {
    $data['showFAQ'] = $_GET['showFAQ'];
    $id = $_GET['id'];
    $db = new ModelQuestion();
    $db->updateQuestion($id, $data, 'showFAQ');
  }

  private function actDelete()
  {
    //TODO: Write method actDelete
  }
}