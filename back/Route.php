<?php


class Route
{
  private static $instance;
  public $url;
  public $uri;
  public $nof;

  public static function getInstance() : Route
  {
    if (self::$instance === null){
      self::$instance = new Route();
    }
    return self::$instance;
  }

  private function __clone(){ }

  public function __construct()
  {
    $this->uri = $_SERVER['REQUEST_URI'] ?? '/';
    $this->url = trim($this->uri, '/ ');
    if (empty($this->url)){
      $this->url = [];
    } else {
      $this->url = explode('/', $this->url);
    }
    $this->nof = count($this->url);
  }

  /*
   * САЙТ ЦРСК
   * Главная                            /
   * О ЦРСК
   *    О ЦРСК                          /about
   *    Порядок зачисления              /admissionProcedure
   * Образовательные проекты
   *    Детский университет             /childrenUniversity
   *    Малая академия                  /smallAcademy
   * Подать заявку
   *    Подать заявку на мероприятия    /applicationEvents
   *    Подать заявку на обучение       /applicationEducation
   * Сведения об организации            /organizationInformation
   * Контакты                           /contacts
   * ЧАВО                               /FAQ
   *
   * АДМИНКА
   * Страница входа       /adm
   * Домашняя страница    /adm/home
   */

  public function go() : Controller
  {
    if ($this->nof > 4) {
      return new Controller404($this->url);
    }
    if (empty($this->url)){
      return new ControllerHome($this->url);
    }
    switch ($this->url[0]){
      case 'news':
        return new ControllerNews($this->url);
        break;
      case 'about':
        return new ControllerAbout($this->url);
        break;
      case 'admissionProcedure':
        return new ControllerAdmissionProcedure($this->url);
        break;
      case 'childrenUniversity':
        return new ControllerChildrenUniversity($this->url);
        break;
      case 'smallAcademy':
        return new ControllerSmallAcademy($this->url);
        break;
      case 'applicationEvents':
        return new ControllerApplicationEvents($this->url);
        break;
      case 'applicationEducation':
        return new ControllerApplicationEducation($this->url);
        break;
      case 'organizationInformation':
        return new ControllerOrganizationInformation($this->url);
        break;
      case 'contacts':
        return new ControllerContacts($this->url);
        break;
      case 'question':
        return new ControllerQuestion($this->url);
        break;
      case 'adm':
        switch ($this->url[1]){
          case 'home':
            return new ControllerAdmHome($this->url);
            break;
          case 'pages':
            return new ControllerAdmPages($this->url);
            break;
          case 'news':
            return new ControllerAdmNews($this->url);
            break;
          case 'events':
            return new ControllerAdmEvents($this->url);
            break;
          case 'programms':
            return new ControllerAdmProgramms($this->url);
            break;
          case 'question':
            return new ControllerAdmQuestion($this->url);
          default:
            return new ControllerAdmLogin($this->url);
            break;
        }
    }
    return new Controller404($this->url);
  }
}