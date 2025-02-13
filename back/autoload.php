<?php

spl_autoload_register(function ($classname)
{
  $folder = __DIR__ . '/';
  if (strpos($classname, 'Controller') === 0) {
    $folder .= 'controllers/';
  } else if (strpos($classname, 'Model') === 0) {
    $folder .= 'models/';
  } else if (strpos($classname, 'Service') === 0) {
    $folder .= 'services/';
  } else if (strpos($classname, 'View') === 0) {
    $folder .= 'views/';
  } else if (strpos($classname, 'Validator') === 0){
    $folder .= 'services/';
  }

  $filename = $folder . $classname . '.php';
  if (file_exists($filename)) {
    require_once $filename;
  }
});