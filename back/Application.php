<?php

class Application
  extends Controller
{

  /** @noinspection MagicMethodsValidityInspection */
  /** @noinspection PhpMissingParentConstructorInspection */
  public function __construct() {
  }


  public function run() {
    session_start();
    // Получить данные
    $route = Route::getInstance();

    // Проверить данные
    $controller = $route->go();

    // Делегируем выполнение в контроллер
    $controller->run();
  }


}