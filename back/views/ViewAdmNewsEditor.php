<?php
include_once 'header.php';
?>
<div class="container">
<h1><?=$t->pageTitle?></h1>
  <form action="/adm/news/save/?id=<?=$t->get?>" method="post">
    <div class="padding">
      <?php if (isset($t->errors['errorDB'])) {echo '<p>' . $t->errors['errorDB'] . '</p>';} ?>
      <h4 align="center">Название новости</h4>
      <?php if (isset($t->errors['title'])) {echo '<p>' . $t->errors['title'] . '</p>';} ?>
      <!--<textarea name="title"><?php if (isset($t->dataInput['title'])){echo $t->dataInput['title'];}?></textarea>-->
      <input type="text" name="title" value="<?php if (isset($t->dataInput['title'])){echo $t->dataInput['title'];}?>">
    </div>
    <div class="padding">
      <?php if (isset($t->errors['errorDB'])) {echo '<p>' . $t->errors['errorDB'] . '</p>';} ?>
      <h4 align="center">Аннотация новости</h4>
      <?php if (isset($t->errors['annotation'])) {echo '<p>' . $t->errors['annotation'] . '</p>';} ?>
      <textarea name="annotation"><?php if (isset($t->dataInput['annotation'])){echo $t->dataInput['annotation'];}?></textarea>
    </div>
    <div class="padding">
      <h4 align="center">Текст новости</h4>
      <?php if (isset($t->errors['text'])) {echo '<p>' . $t->errors['text'] . '</p>';} ?>
      <textarea name="text"><?php if (isset($t->dataInput['text'])){echo $t->dataInput['text'];}?></textarea>
    </div>
    <a href="/adm/news/delete/?id=<?=$t->get?>">Удалить новость</a><br>
  <input type="submit" value="Сохранить">
  </form>
</div>
<!--Футер сайта-->
<?php include_once 'footer.php';
