<?php


class ModelPage
{
  public function getData(string $page) : array {
    $db = DB::getInstance();
    $sql = 'SELECT * FROM page WHERE link=?$';
    return $db->getRow($sql, 's', $page);
  }

  public function saveData(string $page, string $data) : bool {
    $db = DB::getInstance();
    $date = date('d.m.Y H:i');
    $sql = 'UPDATE page SET data=?$, lastData=?$  WHERE link=?$';
    $ok = $db->setData($sql, 'sss', $data, $date, $page);
    if ($ok === true) {
      return true;
    } else {
      $str = __METHOD__ . ' Ошибка записи данных в БД. 
                      Запрос: ' . $sql . '  Параметры: ' . $data . ', ' . $date . ', ' . $page;
      writeFile('dbLog', $str);
      return false;
    }
  }
}