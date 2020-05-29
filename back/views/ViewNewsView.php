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
    <!--Простая секция с изображениями-->
    <div class="container-fluid padding">
      <div class="row padding">
        <div class="offset-lg-1 col-lg-4">
          <h2><?=$t->dataInput['title']?></h2>
          <?=$t->dataInput['text']?><br>
          <em><?=$t->dataInput['date']?></em>
        </div>
        <div class="col-6">
          <br>
          <img class="img-thumbnail" src="<?=$t->dataInput['image']?>">
        </div>
      </div>
    </div>

  <!--Футер сайта-->
<?php include_once 'footer.php';
