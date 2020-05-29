<?php


class ControllerAdmNews extends Controller
{

  public function run()
  {
    // TODO: Implement run() method.
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
      }
      $this->act404();
    } else {
      redirect('/adm/');
    }
  }

  private function actList()
  {
    $t = Template::getInstance();
    $db = new ModelNews();
    $t->dataInput = $db->getData();
    $t->page = 'Admin';
    $t->pageTitle = 'Список новостей';
    include_once TEMPLATES . 'ViewAdmNewsList.php';
  }

  private function actEdit()
  {
    $id = (int)$_GET['id'];
    $t = Template::getInstance();
    $form = new ServiceForm('AdmNews');
    $form->readData();
    if ($form->isError() === true) {
      $t->errors = $form->getErrors();
      $t->data = $form->getData();
    }
    $t->page = 'Admin';
    if ($id !== 0) {
      $db = new ModelNews();
      $t->dataInput = $db->getOne($id);
      $t->pageTitle = 'Редактирование новости';
    }
    $t->pageTitle = 'Создание новости';
    $t->get = $id;
    include_once TEMPLATES . 'ViewAdmNewsEditor.php';
  }

  private function actSave()
  {
    $url = '/adm/news/view';
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' && empty($_GET['id'])) {
      redirect($url);
    }
    $id = (int)$_GET['id'];
    $form = new ServiceForm('AdmNews');
    $form->readData();
    //$this->inputData($form);
    if ($form->isError() === true) {
      $form->saveData();
      redirect('/adm/news/edit/?id=' . $id);
    }
    $data = $form->getData();
    $db = new ModelNews();
    if ($id !== 0) {
      $ok = $db->updateData($id, $data['title'], $data['annotation'], $data['text']);
    } else {
      $ok = $db->saveData($data['title'], $data['annotation'], $data['text']);
    }
    if ($ok === true) {
      $form->clear();
      redirect($url);
    } else {
      $str = __METHOD__ . ' Ошибка записи данных в БД.';
      writeFile('dbLog', $str);
      $form->setValue('errorDB', $str);
      redirect('/adm/news/edit/?id=' . $id);
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
    $url = '/adm/news/view';
    $db = new ModelNews();
    $ok = $db->deleteOne($id);
    $form = new ServiceForm('AdmNews');
    if ($ok === true) {
      $form->clear();
      redirect($url);
    } else {
      $str = __METHOD__ . ' Ошибка записи данных в БД.';
      writeFile('dbLog', $str);
      $form->setValue('errorDB', $str);
      redirect('/adm/news/edit/?id=' . $id);
    }
  }

  private function actAjax()
  {
    var_dump($_POST['text']);
    
  }
}