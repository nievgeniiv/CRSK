<?php
include_once 'header.php';
?>


  <!--Карточки с образовательными проектами-->
  <div class="container-fluid padding">
    <div class="row alert text-center">
      <div class="col-12">
        <h1 class="display-4">Образовательные проекты</h1>
      </div>
      <hr>
    </div>
  </div>
  <div class="container padding">
    <div class="row paddingin">
      <div class="col-md-6">
        <div class="card">
          <img src="/img/Детский_университет.jpg" class="card-img-top">
          <div class="card-body">
            <h4 class="card-title">Детский университет</h4>
            <p class="card-text text-justify">Проект для ребят 5-9 классов, его Цель – создание среды для раскрытия творческих
              способностей детей, их приобщение к научно-познавательной, научно-исследовательской и проектной
              деятельности, а так же формирование творческой и креативной личности. Помимо 4К компетенций особое
              внимание уделяется навыкам работы с информационными ресурсами.</p>
            <a href="/childrenUniversity" class="btn btn-warning">Посмотреть</a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <img src="/img/Малая_академия.jpg" class="card-img-top">
          <div class="card-body">
            <h4 class="card-title">Малая академия</h4>
            <p class="card-text text-justify">Проект для ребят 10-11 классов, его Цель – создание условий для осознанного выбора образовательной траектории,
              формирования современных универсальных компетенций, знаний и навыков, первичных навыков проектного
              управления, командной работы и реализации собственных авторских проектов с которыми можно выступать на
              конференциях, форумах и конкурсах различных уровней.</p>
            <a href="/smallAcademy" class="btn btn-warning">Посмотреть</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Блок с новостями-->
  <div class="container-fluid padding">
    <div class="row text-center alert"> <!--row создатеся ряд; text-center текст ориентирован по-центру; alert свои отступы (они прописаны в css)-->
      <div class="col-12"> <!--col-12 создате колонку равную 12 колонкам bootstrapa (в bootstrape по-умолчанию вся страница делится на 12 равных колонок)-->
        <a href="/news"><h1 class="display-4">Новости</h1></a>  <!--display-4 размер шрифта (как hn в html)-->
      </div>
      <hr>
    </div>
    <div class="row text-center padding">
     <?php
        $i = 0;
        while($i <= count($t->dataInput)-1) {
          echo '
            <div class="col-xs-12 col-sm-6 col-md 4">
              <img class="img-thumbnail" src="' . $t->dataInput[$i]['image'] . '">
              <h3>' . $t->dataInput[$i]['title'] . '</h3>
              ' . $t->dataInput[$i]['annotation'] . '
              <br><hr>
              <em>' . $t->dataInput[$i]['date'] . '</em><br>
              <a href="/news/?id=' . $t->dataInput[$i]['id'] . '" class="btn btn-danger">Читать далее</a>
            </div>
          ';
          $i++;
        }
     ?>
    </div>
  </div> <!--padding свои отступы прописанные в css-->

  <!--Футер сайта-->
<?php include_once 'footer.php';
