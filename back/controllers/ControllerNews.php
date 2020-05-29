<?php


class ControllerNews extends Controller
{

  public function run()
  {
    if (count($this->url) < 2) {
      $this->actList();
      return;
    }
    if (isset($_GET['page'])) {
      $this->actList((int)$_GET['page']);
      return;
    }
    if (isset($_GET['id'])) {
      $this->actView();
      return;
    }
    $this->act404();
  }

  private function actList(int $page = 0)
  {
    $db = new ModelNews();
    $maxId = $db->getCount();
    $t = Template::getInstance();
    if ($maxId % 6 === 0) {
      $t->countPages = $maxId / 6;
    } else {
      $t->countPages = ($maxId / 6) + 1;
    }
    if ($page === 0) {
      $t->dataInput = $db->getLastData(6);
    } else {
      $idLast = $maxId - 6 * ($page - 1);
      $idBegin = $idLast - 5;
      $row = $db->getDataBetween($idBegin, $idLast);
      $t->dataInput = array_reverse($row);
    }
    $t->pageTitle = 'News';
    include_once TEMPLATES . 'ViewNewsList.php';
  }

  private function actView()
  {
    $id = (int)$_GET['id'];
    $db = new ModelNews();
    $t = Template::getInstance();
    $t->dataInput = $db->getOne($id);
    $t->pageTitle = 'News';
    include_once TEMPLATES . 'ViewNewsView.php';
  }
}