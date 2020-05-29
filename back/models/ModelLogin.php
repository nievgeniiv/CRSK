<?php


class ModelLogin
{
  public function checkLogin(string $login, string $passwd) : array
  {
   $db = DB::getInstance();
   $data = [md5($login), md5($passwd)];
   $sql = "SELECT * FROM users WHERE login=?$ and passwd=?$";
   return $db->getRow($sql, 'ss', md5($login), md5($passwd));
  }

  public function saveHash(string $hash, string $id) : bool
  {
    $db = DB::getInstance();
    $date = date('d.m.Y H:i');
    $data = [$hash, $date, $id];
    $sql = "UPDATE users SET hash=?$, lastLogin=?$ WHERE id=?$";
    return $db->setData($sql, 'sss', $hash, $date, $id);
  }

  public function getOne(string $type, string $col, string $dataOutput)
  {
    $db = DB::getInstance();
    $t = Template::getInstance();
    $data = [$t->dataInput];
    $sql = "SELECT " . $dataOutput . " FROM users WHERE " . $col . "=?$";
    return $db->getCell($sql, $type, $t->dataInput);
  }

  public function getHash(string $type, string $col, string $dataOutput)
  {
    $db = DB::getInstance();
    $t = Template::getInstance();
    //$data = [$t->dataInput];
    $sql = "SELECT " . $dataOutput . " FROM users WHERE " . $col . "=?$";
    return $db->getCell($sql, $type, $t->dataInput);
  }
}