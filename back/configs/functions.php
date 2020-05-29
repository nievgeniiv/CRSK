<?php

function redirect(string $url, bool $is_exit = true) {

    if (PHP_SAPI === 'cgi') {
        header('Status: 301 Moved Permanently');
    } else {
        header('HTTP/1.0 301 Moved Permanently');
    }
    header('Location: ' . $url);

    if ($is_exit) {
        exit();
    }
}

function writeFile(string $nameFile, string $str)
{
  $fd = fopen(LOG . $nameFile .".txt", 'a') or die("не удалось создать файл");
  $data = date('d.M.Y H:i:s') . ' ' . $str . "\n";
  fwrite($fd, $data);
  fclose($fd);
}