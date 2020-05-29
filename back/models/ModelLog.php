<?php


class ModelLog
{
  public function WriteLog(string $text) : bool
  {
    $str = date('d.m.Y H:i');
    $fd = fopen("Log.txt", 'a') or die("Не удалось создать файл! Обратитесь к администратору");
    $str .= ' ' . $text . "\n";
    fwrite($fd, $str);
    fclose($fd);
    return true;
  }
}