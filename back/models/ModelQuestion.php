<?php


class ModelQuestion
{
  public function getData(int $page, int $nofInPage) : array
  {
    $db = DB::getInstance();
    $sql = 'SELECT * FROM question WHERE showFAQ=true LIMIT ?$, ?$';
    return $db->getRows($sql, 'ii', $page-1, $nofInPage);
  }

  public function getDataForAdmin(int $page, int $nofInPage) : array
  {
    $db = DB::getInstance();
    $sql = 'SELECT * FROM question LIMIT ?$, ?$';
    return $db->getRows($sql, 'ii', $page-1, $nofInPage);
  }

  public function saveQuestion(array $data)
  {
    $db = DB::getInstance();
    $sql = 'SELECT MAX(Id) as id FROM question';
    $row = $db->getColumn($sql, '');
    $id = $row['0'] + 1 ?? 1;
    $sql = 'INSERT INTO question() VALUES(?$, ?$, ?$, ?$, ?$, ?$, ?$)';
    return $db->setData($sql, 'issssii', $id, $data['question'], '', $data['fromAnswer'], $data['email'],
                          0, 0);
  }

  public function getOne(int $id) : array
  {
    $db = DB::getInstance();
    $sql = 'SELECT question, answer, fromAnswer, id FROM question WHERE id=?$';
    return $db->getRow($sql, 'i', $id);
  }

  public function updateQuestion(int $id, array $data, string $col = 'answer')
  {
    $db = DB::getInstance();
    $sql = 'UPDATE question SET '.$col.'=?$ WHERE id=?$';
    return $db->setData($sql, 'si', $data[$col], $id);
  }
}