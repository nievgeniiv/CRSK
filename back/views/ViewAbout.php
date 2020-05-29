<?php
include_once 'header.php';
?>

<div class="container padding">
  <div class="col-12">
    <h1><?=$t->pageTitle?></h1>
    <?=$t->dataInput['data']?>
  </div>
</div>
<!--Футер сайта-->
<?php include_once 'footer.php';
