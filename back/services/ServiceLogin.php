<?php


class ServiceLogin
{
  private $data;
  private $errors;
  private $key;

  /**
   * ServiceForm constructor.
   * @param $formKey
   */

  public function __construct(string $formKey)
  {
    $this->key = $formKey;
  }

  public function readData()
  {
    if (isset($_SESSION['forms'][$this->key])) {
      $raw = $_SESSION['forms'][$this->key];
      $this->data = $raw['data'];
      $this->errors = $raw['errors'];
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
      unset($this->errors);
      $this->data = $_POST;
      $this->errors = [];
    }
  }

  public function checkLogin($login)
  {
    $data = trim($this->data['username']);
    if (empty($data) === true){
      $this->errors['username'] = 'Данное поле незаполнено';
      return;
    }
    if (md5($data) !== $login) {
      $this->errors['username'] = 'Неверный логин или пароль';
      return;
    }
  }

  public function checkPasswd($passwd)
  {
    $data = trim($this->data['passwd']);
    if (empty($data) === true) {
      $this->errors['passwd'] = 'Данное поле незаполнено';
      return;
    }
    if (md5($data) !== $passwd) {
      $this->errors['passwd'] = 'Неверный логин или пароль';
      return;
    }
  }

  public function saveData()
  {
    $_SESSION['forms'][$this->key] = [
      'data' => $this->data,
      'errors'=>$this->errors];
  }

  public function saveHash(string $id) : bool
  {
    $hash = md5($this->generate_string());
    //setcookie('crskCookie', $hash,'','/adm/','https://k21.center',true);
    $_SESSION['crskCookie'] = $hash;
    $db = new ModelLogin();
    return $db->saveHash($hash, $id);
  }

  private function generate_string(int $strength = 16)
  {
    $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
      $random_character = $input[mt_rand(0, $input_length - 1)];
      $random_string .= $random_character;
    }

    return $random_string;
  }

  public function checkInput() : bool
  {
    /*if (empty($_COOKIE['crskCookie']) or $_COOKIE['crskCookie'] === ''){
      return false;
    }*/
    if (empty($_SESSION['crskCookie']) or $_SESSION['crskCookie'] === '') {
      return false;
    }
    $t = Template::getInstance();
    //$t->dataInput = $_COOKIE['crskCookie'];
    $t->dataInput = $_SESSION['crskCookie'];
    $db = new ModelLogin();
    $row = $db->getOne('s', 'hash', 'id');
    return isset($row);
  }

  public function logOut()
  {
    $t = Template::getInstance();
    $t->dataInput = $_SESSION['crskCookie'];
    $db = new ModelLogin();
    $row = $db->getOne('s', 'hash', 'id');
    $db->saveHash('', $row['id']);
    //setcookie('crskCookie', '','time() - 3600','/adm/','https://k21.center',true);
    unset($_SESSION['crskCookie']);
  }

  public function isError() : bool
  {
    return !empty($this->errors);
  }

  public function getData() : array
  {
    return $this->data;
  }

  public function getErrors() : array
  {
    return $this->errors;
  }

/*public function setValue(string $name, $value)
  {
    $this->errors[$name] = $value;
  }

  public function getValue(string $name)
  {
    return $this->data[$name];
  }*/

  public function clear()
  {
    unset($_SESSION['forms'][$this->key]);
  }

}
