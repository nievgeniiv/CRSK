<?php
include_once 'header.php';
?>



  <!--Блок с новостями-->
  <div class="container-fluid padding">
    <div class="row text-center alert"> <!--row создатеся ряд; text-center текст ориентирован по-центру; alert свои отступы (они прописаны в css)-->
      <div class="col-12"> <!--col-12 создате колонку равную 12 колонкам bootstrapa (в bootstrape по-умолчанию вся страница делится на 12 равных колонок)-->
        <a href="/news"><h1 class="display-4">Новости</h1></a>  <!--display-4 размер шрифта (как hn в html)-->
      </div>
      <hr>
    </div>
    <?php
      $i = 0;
      echo '<div class="row text-center padding">';
      while ($i <= 2) {
        if (isset($t->dataInput[$i]['id'])) {
          echo '
            <div class="col-xs-12 col-sm-6 col-md 4">
              <img src="' . $t->dataInput[$i]['image'] . '">
              <h3>' . $t->dataInput[$i]['title'] . '</h3>
              ' . $t->dataInput[$i]['annotation'] . '
              <br><hr>
              <em>' . $t->dataInput[$i]['date'] . '</em><br>
              <a href="/news/?id=' . $t->dataInput[$i]['id'] . '" class="btn btn-danger">Читать далее</a>
            </div>
          ';
        }
        $i++;
      }
      echo '</div>';
      echo '<div class="row text-center padding">';
      while ($i <= 5) {
        if (isset($t->dataInput[$i]['id'])) {
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
        }
      $i++;
      }
      echo '</div>';
    ?>
  <div class="col-xs-12 col-sm-6 col-md 4">
    <div class="text-center">
      <p>Страницы: <a href="/news">1,</a>
        <?php
        for ($i = 2; $i <= $t->countPages; $i++) {
          echo '<a href="/news/?page=' . $i .'">'. $i .',</a>';
        }
        ?>
      </p>
    </div>
  </div>

  <!--Футер сайта-->
<?php include_once 'footer.php';
