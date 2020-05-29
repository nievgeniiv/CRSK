<?php


class ModelSmallAcademy
{
  public function getData() : array
  {
    $db = DB::getInstance();
    $sql = 'SELECT * FROM programms WHERE EducationProject="Малая академия"';
    return $db->getRows($sql, '');
  }
}