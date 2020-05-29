<?php
include_once 'header.php';
?>
<div class="container">
<h1><?=$t->pageTitle?></h1>
  <form action="/adm/pages/save/?page=<?=$t->get?>" method="post">
  <div>
    <textarea name="data"><?php if (isset($t->dataInput['data'])){echo $t->dataInput['data'];}?></textarea>
  </div>
  <input type="submit" value="Сохранить">
  </form>
</div>
<!--Футер сайта-->
<?php include_once 'footer.php';
