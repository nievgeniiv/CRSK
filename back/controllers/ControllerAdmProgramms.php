<?php


class ControllerAdmProgramms extends Controller
{

  public function run()
  {
    $form = new ServiceLogin('login');
    if ($ok = $form->checkInput() === true) {
      switch ($this->url[2]) {
        case 'view':
          $this->actList();
          return;
        case 'edit':
          $this->actEdit();
          return;
        case 'save':
          $this->actSave();
          return;
        case 'delete':
          $this->actDelete();
          return;
        case 'ajax':
          $this->actAjax();
          return;
        case 'viewChildren':
          $this->actViewChildren();
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
    $db = new ModelProgramms();
    $t->dataInput = $db->getData();
    $t->page = 'Admin';
    $t->pageTitle = 'Список программ';
    include_once TEMPLATES . 'ViewAdmProgrammsList.php';
  }

  private function actEdit()
  {
    $id = (int)$_GET['id'];
    $t = Template::getInstance();
    $form = new ServiceForm('AdmProgramms');
    $form->readData();
    if ($form->isError() === true) {
      $t->errors = $form->getErrors();
      $t->data = $form->getData();
    }
    $t->page = 'Admin';
    if ($id !== 0) {
      $db = new ModelProgramms();
      $t->dataInput = $db->getOne($id);
      $t->pageTitle = 'Редактирование программы';
    }
    $t->pageTitle = 'Создание программы';
    $t->get = $id;
    include_once TEMPLATES . 'ViewAdmProgrammsEditor.php';
  }

  private function actSave()
  {
    $url = '/adm/programms/view';
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' && empty($_GET['id'])) {
      redirect($url);
    }
    $id = (int)$_GET['id'];
    $form = new ServiceForm('AdmProgramms');
    $form->readData();
    //$this->inputData($form);
    if ($form->isError() === true) {
      $form->saveData();
      redirect('/adm/programms/edit/?id=' . $id);
    }
    $data = $form->getData();
    $db = new ModelProgramms();
    if ($id !== 0) {
      $ok = $db->updateData($id, $data['title'], $data['description'], '', '', $data['EducationProject']);
    } else {
      $ok = $db->saveData($data['title'], $data['description'], '', '', $data['EducationProject']);
    }
    if ($ok === true) {
      $form->clear();
      redirect($url);
    } else {
      $str = __METHOD__ . ' Ошибка записи данных в БД.';
      writeFile('dbLog', $str);
      $form->setValue('errorDB', $str);
      redirect('/adm/programms/edit/?id=' . $id);
    }
  }

  private function inputData(ServiceForm $form)
  {
    $form->checkField('title', 'string', true);
    $form->checkField('description', 'string', true);
    $form->checkField('EducationProject', 'string', true);
  }

  private function actDelete()
  {
    $id = (int)$_GET['id'];
    $url = '/adm/programms/view';
    $db = new ModelProgramms();
    $ok = $db->deleteOne($id);
    $form = new ServiceForm('AdmProgramms');
    if ($ok === true) {
      $form->clear();
      redirect($url);
    } else {
      $str = __METHOD__ . ' Ошибка записи данных в БД.';
      writeFile('dbLog', $str);
      $form->setValue('errorDB', $str);
      redirect('/adm/programms/edit/?id=' . $id);
    }
  }

  private function actAjax()
  {
    $id = (int)$_GET['id'];
    if (isset($_GET['activate'])) {
      $value = (int)$_GET['activate'];
      $db = new ModelProgramms();
      $ok = $db->updateActivate($id, $value);
    }
    if (isset($_GET['complite']) and (int)$_GET['complite'] === 1) {
      $value = (int)$_GET['complite'];
      $db = new ModelApplicationEducation();
      $ok = $db->updateComplite($id, $value);
    }
    if (isset($_GET['delete']) and (int)$_GET['delete'] === 1) {
      $db = new ModelApplicationEducation();
      $ok = $db->deleteOne($id);
    }
  }

  private function actViewChildren()
  {
    $t = Template::getInstance();
    $t->page = 'Admin';
    if (isset($_GET['edit']) and (int)$_GET['edit'] === 1) {
      $id = (int)$_GET['id'];
      $t->pageTitle = 'Редактировать запись';
      $db = new ModelApplicationEducation();
      $t->dataInput = $db->getData($id)[0];
      include_once TEMPLATES . 'ViewAdmApplicationEducation.php';
      return;
    }
    $t->pageTitle = 'Список детей';
    $db = new ModelApplicationEducation();
    $t->dataInput = $db->getList();
    include_once TEMPLATES . 'ViewAdmViewChildren.php';
  }
}