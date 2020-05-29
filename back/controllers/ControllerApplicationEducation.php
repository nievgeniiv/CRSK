<?php


class ControllerApplicationEducation extends Controller
{
  public function run()
  {
    if (count($this->url) < 2) {
      $this->actView();
      return;
    }
    switch ($this->url[1]) {
      case 'save':
        $this->actSave();
        return;
      case 'complite':
        $this->actComplite();
        return;
    }
    $this->act404();
  }

  private function actView()
  {
    /*$t = Template::getInstance();
    $db = new ModelProgramms();
    $t->program = $db->getList();
    $t = Template::getInstance();
    $form = new ServiceForm('ApplicationEducation');
    $form->readData();
    if ($form->isError() === true) {
      $t->errors = $form->getErrors();
      $t->data = $form->getData();
    }
    $t->pageTitle = 'Подать заявку';
    include_once TEMPLATES . 'ViewApplicationEducation.php';*/
    $t = Template::getInstance();
    $t->pageTitle = 'Дорогой друг, подача заявок откроется после 15 июля. Если у тебя есть какие-то вопросы, ты можешь 
                      связаться с нашим администратором +7-962-778-4288';
    include_once TEMPLATES . 'ViewApplicationEducationComplite.php';
  }

  private function actComplite()
  {
    $t = Template::getInstance();
    $t->pageTitle = 'Ваша заявка принята. В течении 5 рабочих дней с Вами свяжется администратор.';
    include_once TEMPLATES . 'ViewApplicationEducationComplite.php';
  }

  private function actSave()
  {
    $url = '/applicationEducation';
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      redirect($url);
    }
    $form = new ServiceForm('ApplicationEducation');
    $form->readData();
    $this->inputData($form);
    if ($form->isError() === true) {
      $form->saveData();
      redirect($url);
    }
    $data = $form->getData();
    $db = new ModelApplicationEducation();
    $ok = $db->saveData($data['fioChildren'], $data['dateChildren'], $data['schoolChildren'], $data['classChildren'],
                        $data['phoneChildren'], $data['emailChildren'], $data['programmChildren'], $data['fioParent'],
                        $data['phoneParent'], $data['emailParent']);
    if ($ok === true) {
      $form->clear();
      redirect('/applicationEducation/complite');
    } else {
      $str = __METHOD__ . ' Ошибка записи данных в БД.';
      writeFile('dbLog', $str);
      $form->setValue('errorDB', $str);
      redirect($url);
    }
  }

  private function inputData(ServiceForm $form)
  {
    $form->checkField('fioChildren', 'FIO', true);
    $form->checkField('dateChildren', 'string', true);
    $form->checkField('schoolChildren', 'string', false);
    $form->checkField('classChildren', 'string', true);
    $form->checkField('phoneChildren', 'phone', true);
    $form->checkField('emailChildren', 'email', false);
    $form->checkField('programmChildren', 'string', true);
    $form->checkField('fioParent', 'string', true);
    $form->checkField('phoneParent', 'string', true);
    $form->checkField('emailParent', 'string', false);
  }
}