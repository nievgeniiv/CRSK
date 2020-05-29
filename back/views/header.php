<?php
  $t = Template::getInstance();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie-edge">
  <title>ЦРСК ТГУ им. Менделеева (федеральная сеть ДНК)</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://cdn.tiny.cloud/1/m7w9fvutzei2okqzwgt2a7t6ka3d9stgdzxbhanxled8vh6a/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <?php
    if (!isset($t->tinyMCE)) {
      echo '<script>tinymce.init({selector:\'textarea\', language: "ru"});</script>';
    }
  ?>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap-social.css" />
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/flatpickr.css">
  <link rel="stylesheet" type="text/css" href="/css/drag-and-drop.css">
  <link rel="stylesheet" type="text/css" href="/css/jquery-ui.min.css">
  <link rel="stylesheet" type="text/css" href="/css/jquery-ui.structure.css">
  <link rel="stylesheet" type="text/css" href="/css/jquery-ui.theme.css">
  <link rel="stylesheet" href="/css/main.css?v=1.5">
</head>
<body>
<!--Шапка сайта-->
<?php if ($t->page === 'Admin') {
  echo '
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <a href="/" class="navbar-brand"><img src="/img/logo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"> <!--data-target указывается id элемента которое должно помещено в кнопку-->
      <span class="navbar-toggler-icon"></span>
    </button>   <!--Кнопка меню, появляется если маленький экран (например мобильные устройства)-->
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="/adm/home" class="nav-link">Главная админки</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Содержание страниц</a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <a href="/adm/pages/view/?page=about" class="dropdown-item" type="button">О ЦРСК</a>
            <a href="/adm/pages/view/?page=admissionProcedure" class="dropdown-item" type="button">Порядок зачисления</a>
            <a href="/adm/pages/view/?page=organizationInformation" class="dropdown-item" type="button">Сведения об организации</a>
            <a href="/adm/question" class="dropdown-item" type="button">Вопрос/ответ</a>
            <a href="/adm/pages/view/?page=contacts" class="dropdown-item" type="button">Контакты</a>
          </div>
        </li>
        <li class="nav-item">
          <a href="/adm/events/view" class="nav-link">Мероприятия</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Программы</a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <a href="/adm/programms/view" class="dropdown-item" type="button">Программы обучения</a>
            <a href="/adm/programms/viewChildren" class="dropdown-item" type="button">Список записавшихся детей</a>
          </div>
        </li>
        <li class="nav-item">
          <a href="/adm/news/view" class="nav-link">Добавить/редактировать новость</a>
        </li>
      </ul>
    </div>
  </div>
</nav>';
} else {
  echo '
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
  <div class="container-fluid">
    <a href="/" class="navbar-brand"><img src="/img/logo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"> <!--data-target указывается id элемента которое должно помещено в кнопку-->
      <span class="navbar-toggler-icon"></span>
    </button>   <!--Кнопка меню, появляется если маленький экран (например мобильные устройства)-->
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="/" class="nav-link">Главная</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">О ЦРСК</a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <a href="/about" class="dropdown-item" type="button">О ЦРСК</a>
            <a href="/admissionProcedure" class="dropdown-item" type="button">Порядок зачисления</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Образовательные проекты</a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <a href="/childrenUniversity" class="dropdown-item" type="button">Детский университет</a>
            <a href="/smallAcademy" class="dropdown-item" type="button">Малая академия</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Подать заявку</a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <a href="/applicationEducation" class="dropdown-item" type="button">Подать заявку на обучение</a>
<!--            <a href="/applicationEvents" class="dropdown-item" type="button">Подать заявку на участие в мероприятии</a>-->
          </div>
        </li>
        <li class="nav-item">
          <a href="/organizationInformation" class="nav-link">Сведения об организации</a>
        </li>
        <li class="nav-item">
          <a href="/question" class="nav-link">Задать вопрос</a>
        </li>
        <li class="nav-item">
          <a href="/contacts" class="nav-link">Контакты</a>
        </li>
      </ul>
    </div>
  </div>
</nav>';
}?>


<?php if ($t->pageTitle === 'Home') {

  echo '
<!--Слайдер изображений-->
<div class="carousel slide" data-ride="carousel" id="slides">
  <div class="carousel-inner">
    <ul class="carousel-indicators">
      <li data-target="#slides" data-slide-to="0" class="active"></li>
      <li data-target="#slides" data-slide-to="1"></li>
      <li data-target="#slides" data-slide-to="2"></li>
    </ul>
    <div class="carousel-item active mobil">
      <img src="/img/slider_1.jpg" >
      <div class="carousel-caption" id="name">
        <h1 class="display-2">Центр развития современных компетенций детей и молодежи
          Томского государственного университета</h1>
        <a href="/applicationEducation" type="button" class="btn btn-primary btn-lg btn-custom">Подать заявку</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="/img/Детский_университет.jpg">
      <div class="carousel-caption">
        <h1 class="display-2">Детский университет</h1>
        <a href="/applicationEducation" type="button" class="btn btn-primary btn-lg btn-custom">Подать заявку</a>
      </div>
    </div>
    <div class="carousel-item">
      <img class="img-custom" src="/img/Малая_академия.jpg">
      <div class="carousel-caption">
        <h1 class="display-2">Малая академия</h1>
        <a href="/applicationEducation" type="button" class="btn btn-primary btn-lg btn-custom">Подать заявку</a>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#slides" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#slides" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>';
} else {
  echo '
  <div>
    <img src="/img/headerNoHome.png" class="img-fluid">
  </div>';
}
?>
