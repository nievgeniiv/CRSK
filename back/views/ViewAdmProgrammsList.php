<?php
include_once 'header.php';
?>
<div class="container">
<h1><?=$t->pageTitle?></h1>
  <div class="row padding">
    <div class="col-sm-6 padding">
      <h4>Название программы</h4>
    </div>
    <div class="col-sm-6 padding">
      <h4>Открыть/Закрыть набор на программу</h4>
    </div>
  </div>
<?php
  $i = 0;
  while (isset($t->dataInput[$i])) {
    echo '
    <div class="row">
      <div class="col-sm-6 padding">
        <a href="/adm/programms/edit/?id=' . $t->dataInput[$i]['id'] . '">' . $t->dataInput[$i]['title'] . '</a>
      </div>
      <div class="col-sm-6 padding">
        <form action="/adm/programms/ajax/?id=' . $t->dataInput[$i]['id'] . '&" method="get">
          <input type="checkbox" class="activeProgramm" id="' . $t->dataInput[$i]['id'] . '" name="activate" value="true" ';
            if ($t->dataInput[$i]['activate'] === '1') {
              echo 'checked';
            } else {
              echo '';
            }
          echo '>
        </form>
      </div>
    </div>';
    $i++;
  }
?>
  <a href="/adm/programms/edit/?id=0">Добавить программу</a>
</div>
<!--Футер сайта-->
<?php include_once 'footer.php';
