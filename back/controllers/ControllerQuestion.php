<?php


class ControllerQuestion extends Controller
{

  public function run()
  {
    if (count($this->url) > 2)
    {
      $this->act404();
      return;
    }
    switch ($this->url[1]) {
      case '':
        $this->actView();
        return;
      case 'save':
        $this->actSave();
        return;
    }
    $this->act404();
  }

  private function actView()
  {
    //TODO: Write pagination
    $t = Template::getInstance();
    $form = new ServiceForm('FAQ');
    $form->readData();
    if ($form->isError() === true) {
      $t->errors = $form->getErrors();
      $t->data = $form->getData();
    }
    $page = $_GET['page'] ?? 1;
    $nofInPage = 10;
    $t->tinyMCE = false;
    $t->pageTitle = 'Вопрос/ответ';
    $db = new ModelQuestion();
    $t->data = $db->getData($page, $nofInPage);
    if (isset($_SESSION['questionComplite']) and $_SESSION['questionComplite'] === true) {
      $t->questionComplite = 'Ваш вопрос принят на обработку. Ответ будет отправлен Вам на почту либо Вам перезвонят';
      unset($_SESSION['questionComplite']);
    }
    include_once TEMPLATES . 'ViewQuestion.php';
  }

  private function actSave()
  {
    $url = '/question';
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      redirect($url);
    }
    $form = new ServiceForm('FAQ');
    $form->readData();
    $this->inputData($form);
    if ($form->isError() === true) {
      $form->saveData();
      redirect('/question');
    }
    $data = $form->getData();
    $db = new ModelQuestion();
    $ok = $db->saveQuestion($data);
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
    $form->checkField('fromAnswer', 'FIO', true);
    $form->checkField('email', 'email', true);
    $form->checkField('question', '', true);
  }
}