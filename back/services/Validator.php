<?php


class Validator
{
  public static function Email(string $data) : bool {
    $data_modern = stripslashes($data);
    $data_modern = strip_tags($data_modern);
    $data_modern = htmlspecialchars($data_modern);
    if (!filter_var($data_modern, FILTER_VALIDATE_EMAIL)){
      return true;
    }
    return false;
  }

  public static function Phone(string $data) : bool {
    $data_modern = stripslashes($data);
    $data_modern = strip_tags($data_modern);
    $data_modern = htmlspecialchars($data_modern);
    $ok1 = preg_match("/[+][7][0-9]{3}[0-9]{3}[0-9]{2}[0-9]{2}$/i", $data_modern);
    $ok2 = preg_match("/[8][0-9]{3}[0-9]{3}[0-9]{2}[0-9]{2}$/i", $data_modern);
//      var_dump($ok1);
//      var_dump($ok2);
    if ($ok1 === 1 || $ok2 === 1) {
      return true;
    } else {
      return false;
    }
    //return preg_match("/[+][7][0-9]{3}[0-9]{3}[0-9]{2}[0-9]{2}$/i", $data_modern);
  }

  public static function Fio(string $data) : bool {
    $data_modern = stripslashes($data);
    $data_modern = strip_tags($data_modern);
    $data_modern = htmlspecialchars($data_modern);
    return preg_match('/^[а-яёА-ЯЁ\s]+$/u', $data_modern);
  }

  public static function DeleteHTMLSymbol(string $data) : string
  {
    $data = stripslashes($data); //убирает экранирование символов
    $data = strip_tags($data); //убирает HTML и PHP тэги
    return htmlspecialchars($data);
  }

  public static function CheckReCaptcha(string $data) : bool
  {
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = google_secret_key;
    $recaptcha_response = $data;
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);
    if ($recaptcha->score >= 0.5) {
      return true;
    } else {
      return false;
    }
  }
}