<?php


class ModelApplicationEducation
{
  public function getData(int $id) : array
  {
    $db = DB::getInstance();
    $sql = 'SELECT * FROM applicationEducation WHERE id=?$';
    return $db->getRows($sql, 'i', $id);
  }

  public function updateComplite(int $id, int $value) : bool
  {
    $db = DB::getInstance();
    $sql = 'UPDATE applicationEducation SET complite=?$ WHERE id=?$';
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

  public function updateData(int $id, string $title, string $description, string $image, string $file,
                           string $EducationProject) : bool
  {
    $db = DB::getInstance();
    //$date = date('d.m.Y H:i');
    $sql = 'UPDATE programms SET title=?, description=?, image=?, file=?, EducationProject=?  WHERE id=?';
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

  public function saveData(string $fioChildren, string $dateChildren, string $schoolChildren, string $classChildren,
                            string $phoneChildren, string $emailChildren, string $programmChildren,
                            string $fioParent, string $phoneParent, string $emailParent) : bool
  {
    $db = DB::getInstance();
    $date = date('d.m.Y');
    $sql = 'SELECT MAX(Id) as id FROM applicationEducation';
    $row= $db->getColumn($sql, '');
    $id = $row['0'] + 1 ?? 1;
    $sql = 'INSERT INTO applicationEducation() VALUES(?$, ?$, ?$, ?$, ?$, ?$, ?$, ?$, ?$, ?$, ?$, ?$, false)';
    $ok = $db->setData($sql, 'isssssssssss',
                        $id, $fioChildren, $dateChildren, $schoolChildren, $classChildren, $phoneChildren,
                        $emailChildren, $programmChildren, $fioParent, $phoneParent, $emailParent, $date);
    if ($ok === true) {
      return true;
    } else {
      $str = __METHOD__ . ' Ошибка записи данных в БД. 
                      Запрос: ' . $sql . '  Параметры: ' . $id . ', ' . $fioChildren . ', ' . $dateChildren .
                      ', ' . $schoolChildren . ', ' . $classChildren . ', ' . $phoneChildren . ', ' . $emailChildren .
                      ', ' . $programmChildren . ', ' . $fioParent . ', ' . $phoneParent . ', ' . $emailParent .
                      ', ' . $date . ', false';
      writeFile('dbLog', $str);
      return false;
    }
  }

  public function deleteOne(int $id) : bool
  {
    $db = DB::getInstance();
    $sql = 'INSERT INTO trashApplicationEducation SELECT * FROM applicationEducation WHERE id=?$';
    $ok = $db->setData($sql, 'i', $id);
    if ($ok === false) {
      $str = __METHOD__ . ' Ошибка записи данных в БД. 
                      Запрос: ' . $sql . '  Параметры: ' . $id;
      writeFile('dbLog', $str);
      return false;
    }
    $sql = 'DELETE FROM applicationEducation WHERE id=?$';
    $ok = $db->setData($sql, 'i', $id);
    if ($ok === true) {
      $sql = 'SELECT MAX(Id) as id FROM applicationEducation';
      $maxId= $db->getColumn($sql, '')[0];
      $i = (int)$id + 1;
      while($i <= (int)$maxId){
        $k = $i - 1;
        $sql = 'UPDATE applicationEducation SET id=?$ WHERE id=?$';
        $db->setData($sql, 'ii', $k, $i);
        $i++;
      }
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
    $sql = 'SELECT id, fioChildren, classChildren, programmChildren,
            fioParent, phoneParent, emailParent, date, complite FROM applicationEducation';
    return $db->getRows($sql, '');
  }
}