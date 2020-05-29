<?php


class ModelAbout
{

  public function getData() : array
  {
    $db = DB::getInstance();
    $sql = 'SELECT * FROM page WHERE link="about"';
    return $db->getRows($sql,'');
  }
}