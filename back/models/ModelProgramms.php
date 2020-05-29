<?php


class ModelProgramms
{
  public function getData() : array
  {
    $db = DB::getInstance();
    $sql = 'SELECT id, title, activate FROM programms';
    return $db->getRows($sql, '');
  }

  public function getOne(int $id) : array
  {
    $db = DB::getInstance();
    $sql = 'SELECT * FROM programms WHERE id=?$';
    return $db->getRow($sql, 'i', $id);
  }

  public function updateData(int $id, string $title, string $description, string $image, string $file,
                           string $EducationProject) : bool
  {
    $db = DB::getInstance();
    //$date = date('d.m.Y H:i');
    $sql = 'UPDATE programms SET title=?$, description=?$, image=?$, file=?$, EducationProject=?$  WHERE id=?$';
    $ok = $db->setData($sql, 'sssssi', $title, $description, $image, $file, $EducationProject, $id);
    if ($ok === true) {
      return true;
    } else {
      $str = __METHOD__ . ' Ошибка записи данных в БД. 
                      Запрос: ' . $sql . '  Параметры: ' . $title . ', ' . $description . ', ' . $image . ', ' . $file .
                      ', ' . $EducationProject . ', ' . $id;
      writeFile('dbLog', $str);
      return false;
    }
  }

  public function updateActivate(int $id, int $value) : bool
  {
    $db = DB::getInstance();
    $sql = 'UPDATE programms SET activate=?$ WHERE id=?$';
    $ok = $db->setData($sql, 'ii', $value, $id);
    if ($ok === true) {
      return true;
    } else {
      $str = __METHOD__ . ' Ошибка записи данных в БД. 
                      Запрос: ' . $sql . '  Параметры: ' . $value . ', ' . $id;
      writeFile('dbLog', $str);
      return false;
    }
  }

  public function saveData(string $title, string $description, string $image, string $file,
                             string $EducationProject) : bool
  {
    $db = DB::getInstance();
    //$date = date('d.m.Y H:i');
    $sql = 'SELECT MAX(Id) as id FROM programms';
    $row= $db->getColumn($sql, '');
    $id = $row['0'] + 1;
    $sql = 'INSERT INTO programms() VALUES(?$, ?$, ?$, ?$, ?$, ?$, false)';
    $ok = $db->setData($sql, 'isssss', $id, $title, $description, $image, $file, $EducationProject);
    if ($ok === true) {
      return true;
    } else {
      $str = __METHOD__ . 'Ошибка записи данных в БД. 
                      Запрос: ' . $sql . '  Параметры: ' . $id . ', ' . $title . ', ' . $description . ', ' . $image .
                      ', ' . $file . ', ' . $EducationProject . ', 0';
      writeFile('dbLog', $str);
      return false;
    }
  }

  public function deleteOne(int $id) : bool
  {
    $db = DB::getInstance();
    $sql = 'DELETE FROM programms WHERE id=?$';
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

  public function getList() : array
  {
    $db = DB::getInstance();
    $sql = 'SELECT title, activate FROM programms';
    return $db->getRows($sql, '');
  }
}