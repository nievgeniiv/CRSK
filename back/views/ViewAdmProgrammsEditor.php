<?php
include_once 'header.php';
?>
<div class="container">
<h1><?=$t->pageTitle?></h1>
  <form action="/adm/programms/save/?id=<?=$t->get?>" method="post">
    <div class="padding">
      <?php if (isset($t->errors['errorDB'])) {echo '<p>' . $t->errors['errorDB'] . '</p>';} ?>
      <h4 align="center">Название программы</h4>
      <?php if (isset($t->errors['title'])) {echo '<p>' . $t->errors['title'] . '</p>';} ?>
      <input type="text" name="title" value="<?php if (isset($t->dataInput['title'])){echo $t->dataInput['title'];}?>">
      <!--<textarea name="title"><?php if (isset($t->dataInput['title'])){echo $t->dataInput['title'];}?></textarea>-->
    </div>
    <div class="padding">
      <h4 align="center">Описание программы</h4>
      <?php if (isset($t->errors['description'])) {echo '<p>' . $t->errors['description'] . '</p>';} ?>
      <textarea name="description"><?php if (isset($t->dataInput['description'])){echo $t->dataInput['description'];}?></textarea>
    </div>
    <div class="padding">
      <h4>Образовательный проект</h4>
      <select name="EducationProject">
        <option <?php
          if ($t->dataInput['EducationProject'] === 'Детский университет') {
            echo 'selected';
          } else {
            echo '';
          }
        ?>>Детский университет</option>
        <option <?php
        if ($t->dataInput['EducationProject'] === 'Малая академия') {
          echo 'selected';
        } else {
          echo '';
        }
        ?>>Малая академия</option>
      </select>
    </div>
    <a href="/adm/programms/delete/?id=<?=$t->get?>">Удалить программу</a><br>
  <input type="submit" value="Сохранить">
  </form>
</div>
<!--Футер сайта-->
<?php include_once 'footer.php';
