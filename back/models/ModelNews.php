<?php


class ModelNews
{

  public function getDataBetween(int $begin, int $last) : array
  {
    $db = DB::getInstance();
    $sql = 'SELECT * FROM news WHERE id BETWEEN ' . $begin . ' AND ' . $last;
    return $db->getRows($sql, '');
  }

  public function getCount() : int
  {
    $db = DB::getInstance();
    $sql = 'SELECT MAX(Id) as id FROM news';
    return $row = $db->getColumn($sql, '')[0];
  }

  public function getLastData(int $nof) : array
  {
    $db = DB::getInstance();
    $sql = 'SELECT * FROM news ORDER BY `id` DESC limit ' . $nof;
    return $db->getRows($sql, '');
  }

  public function getData() : array
  {
    $db = DB::getInstance();
    $sql = 'SELECT id, title FROM news';
    return $db->getRows($sql, '');
  }

  public function getOne(int $id) : array
  {
    $db = DB::getInstance();
    $sql = 'SELECT * FROM news WHERE id=?$';
    return $db->getRow($sql, 'i', $id);
  }

  public function updateData(int $id, string $title, string $annotation, string $text) : bool
  {
    $db = DB::getInstance();
    $date = date('d.m.Y');
    $sql = 'UPDATE news SET title=?$, annotation=?$, text=?$, date=?$ WHERE id=?$';
    $ok = $db->setData($sql, 'ssssi', $title, $annotation, $text, $date, $id);
    if ($ok === true) {
      return true;
    } else {
      $str = __METHOD__ . ' Ошибка записи данных в БД. 
           Запрос: ' . $sql . '  Параметры: ' . $title . ', ' . $annotation . ', ' . $text . ', ' . $date . ', ' . $id;
      writeFile('dbLog', $str);
      return false;
    }
  }

  public function saveData(string $title, string $annotation, string $text) : bool
  {
    $db = DB::getInstance();
    $date = date('d.m.Y');
    $sql = 'SELECT MAX(Id) as id FROM news';
    $row= $db->getColumn($sql, '');
    $id = $row['0'] + 1;
    $sql = 'INSERT INTO news() VALUES(?$, ?$, ?$, ?$, ?$, ?$)';
    $image = '';
    $ok = $db->setData($sql, 'isssss', $id, $title, $annotation, $text, $image, $date);
    if ($ok === true) {
      return true;
    } else {
      $str = __METHOD__ . ' Ошибка записи данных в БД. 
           Запрос: ' . $sql . '  Параметры: ' . $id . ', ' . $title . ', ' . $annotation . ', ' . $text . ', ' . $image . ', ' . $date;
      writeFile('dbLog', $str);
      return false;
    }
  }

  public function deleteOne(int $id) : bool
  {
    $db = DB::getInstance();
    $sql = 'DELETE FROM news WHERE id=?$';
    $ok = $db->setData($sql, 'i', $id);
    if ($ok === true) {
      return true;
    } else {
      $str = __METHOD__ . ' Ошибка записи данных в БД. 
                      Запрос: ' . $sql . '  Параметры: ' . $id;
      writeFile('dbLog', $str);
      return false;
    }
  }
}
