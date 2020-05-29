<?php
include_once 'header.php';
?>
  <div class="container -fluid">
<div class="col-12 text-justify">
  <h1><?=$t->pageTitle?></h1>
  <?php
    $i = 0;
    while ($i <= count($t->dataInput)) {
      if ($t->dataInput[$i]['activate'] === '1') {
        echo '
          <div class="row about">
            <div class="col-sm-6 about">
              <a href="/applicationEvents/view/?id=' . $t->dataInput[$i]['id'] . '">' . $t->dataInput[$i]['title'] . '</a>
            </div>
          </div>';
      }
      $i++;
    }
  ?>
</div>
  </div>
<!--Футер сайта-->
<?php include_once 'footer.php';
