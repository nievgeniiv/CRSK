<?php


/**
 * @property string pageTitle
 * @property array loginError
 * @property array loginData
 * @property mixed dataInput
 * @property array content
 * @property int id
 * @property string page
 * @property mixed get
 * @property array errors
 * @property array program
 * @property float|int countPages
 * @property mixed tinyMCE
 * @property mixed|string questionComplite
 */
class Template
{
  private static $instance;
  private $data;

  public static function getInstance() : Template
  {
    if (self::$instance === null) {
      self::$instance = new Template();
    }
    return self::$instance;
  }

  private function __construct()
  {
    $this->data = [];
  }

  public function __get(string $name) {
    return $this->data[$name];
  }

  public function __set(string $name, $value) {
    $this->data[$name] = $value;
  }

  public function __isset(string $name) : bool  {
    return isset($this->data[$name]);
  }

  public function safe(string $name, $default) {
    if ($this->__isset($name)) {
      return $this->__get($name);
    }
    return $default;
  }

  public function formatError(string $message): string {
    return '<p class="error-message">' . $message . '</p>';
  }
}