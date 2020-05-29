<?php
include_once 'header.php';
?>
<div class="container">
<h1><?=$t->pageTitle?></h1>
  <div class="row padding">
    <div class="col-sm-6 padding">
      <h4>Название новости</h4>
    </div>
  </div>
<?php
  $i = 0;
  while (isset($t->dataInput[$i])) {
    echo '
    <div class="row">
      <div class="col-sm-6 padding">
        <a href="/adm/news/edit/?id=' . $t->dataInput[$i]['id'] . '">' . $t->dataInput[$i]['title'] . '</a>
      </div>
    </div>';
    $i++;
  }
?>
  <a href="/adm/news/edit/?id=0">Добавить новость</a>
</div>
<!--Футер сайта-->
<?php include_once 'footer.php';
