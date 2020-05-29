<?php
include_once 'header.php';
?>

  <div class="container-fluid padding">
    <div class="row alert text-center">
      <div class="col-12">
        <h1 class="display-4"><?=$t->pageTitle?></h1>
      </div>
      <hr>
    </div>
  </div>
<?=$t->dataInput['data']?>

<!--Футер сайта-->
<?php include_once 'footer.php';
