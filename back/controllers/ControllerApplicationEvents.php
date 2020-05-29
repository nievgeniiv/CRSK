<?php


class ControllerApplicationEvents extends Controller
{

  public function run()
  {
    if (count($this->url) < 2) {
      $this->actList();
      return;
    }
    switch ($this->url[1]) {
      case 'view':
        $this->actView();
        return;
      case 'save':
        $this->actSave();
        return;
      case 'complite':
        $this->actComplite();
        return;
    }
    $this->act404();
  }

  private function actList()
  {
    $t = Template::getInstance();
    $db = new ModelApplicationEvents();
    $t->dataInput = $db->getList();
    $t->pageTitle = 'Подать заявку на мероприятие';
    include_once TEMPLATES . 'ViewApplicationEvents.php';
  }

  private function actView()
  {
    $id = (int)$_GET['id'];
    $t = Template::getInstance();
    $t->get = $id;
    $t->pageTitle = 'Подать заявку на мероприятие';
    include_once TEMPLATES . 'ViewApplicationEvents' . $id . '.php';
  }

  private function actSave()
  {
    $id = (int)$_GET['id'];
    $url = '/applicationEvents/view/?id=' . $id;
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      redirect($url);
    }
    $form = new ServiceForm('ApplicationEvents');
    $form->readData();
    $this->inputData($form);
    if ($form->isError() === true) {
      $form->saveData();
      redirect($url);
    }
    if (empty($_POST['checkbox1']) AND empty($_POST['checkbox2']) AND empty($_POST['checkbox3'])
      AND empty($_POST['checkbox4'])) {
      $_SESSION['form']['ApplicationEvents']['programm']['error'] = 'Не выбрана программа!';
      redirect($url);;
    }
    $data = $form->getData();
    var_dump($data);
    $programm = '';
    $programmParent = '';
    $db = new ModelApplicationEvents();
    if (isset($_POST['checkbox1'])) {
      $programm .= $data['checkbox1'];
    }
    if (isset($_POST['checkbox2'])) {
      $programm .= '; ' . $data['checkbox2'];
    }
    if (isset($_POST['checkbox3'])) {
      $programmParent .= $data['checkbox3'];
    }
    if (isset($_POST['checkbox4'])) {
      $programmParent .= '; ' . $data['checkbox4'];
    }
    $ok = $db->saveData($id, $data['fioChildren'], $data['schoolChildren'], $data['classChildren'],
      $data['phoneChildren'], $data['emailChildren'], $programm, $data['school'], $data['fioParent'], $data['position'],
      $data['phoneParent'], $data['emailParent'], $programmParent);
    if ($ok === true) {
      $form->clear();
      redirect('/applicationEvents/complite');
    } else {
      $str = __METHOD__ . ' Ошибка записи данных в БД.';
      writeFile('dbLog', $str);
      $form->setValue('errorDB', $str);
      redirect($url);
    }
  }

  private function actComplite()
  {
    $t = Template::getInstance();
    $t->pageTitle = 'Ваша заявка принята.';
    include_once TEMPLATES . 'ViewApplicationEventsComplite.php';
  }

  private function inputData(ServiceForm $form)
  {
    if (isset($_POST['checkbox1']) or isset($_POST['checkbox2'])) {
      $form->checkField('fioChildren', 'FIO', true);
      $form->checkField('schoolChildren', 'string', false);
      $form->checkField('classChildren', 'string', true);
      $form->checkField('phoneChildren', 'phone', true);
      $form->checkField('emailChildren', 'email', false);
    }
    if (isset($_POST['checkbox3']) or isset($_POST['checkbox3'])) {
      $form->checkField('school', 'string', true);
      $form->checkField('fioParent', 'string', true);
      $form->checkField('position', 'string', true);
      $form->checkField('phoneParent', 'string', true);
      $form->checkField('emailParent', 'string', false);
    }
  }
}
