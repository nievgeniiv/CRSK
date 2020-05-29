<?php
include_once 'header.php';
?>
<div class="container -fluid">
  <div class="row padding">
    <div class="col-sm-12 padding text-center">
      <h1><?=$t->pageTitle?></h1>
      <p class="warning">Символом '*' обозначены обязательные поля</p>
    </div>
  </div>
  <?php if(isset($t->errors['errorDB'])) {echo '<p class="warning">' . $t->errors['errorDB'] . '</p><br>';} ?>
  <form action="/applicationEducation/save" method="post">
  <!--<form action="#" method="post">-->
    <div class="row padding">
      <div class="col-sm-12 padding text-center">
        <h4>Информация о ребенке</h4>
      </div>
    </div>
    <div class="row padding">
      <div class="col-sm-6 padding text-right">
        <p>ФИО ребенка (полностью)*</p>
      </div>
      <div class="col-sm-6 padding text-left">
        <?php if(isset($t->errors['fioChildren'])) {echo '<p class="warning">' . $t->errors['fioChildren'] . '</p><br>';} ?>
        <input type="text" name="fioChildren" value="<?php if(isset($t->data['fioChildren'])) {echo $t->data['fioChildren'];} ?>">
      </div>
    </div>
    <div class="row padding">
      <div class="col-sm-6 padding text-right">
        <p>Дата рождения ребенка (формат: день.месяц.год)*</p>
      </div>
      <div class="col-sm-6 padding text-left">
        <?php if(isset($t->errors['dateChildren'])) {echo '<p class="warning">' . $t->errors['dateChildren'] . '</p><br>';} ?>
        <input type="text" name="dateChildren" value="<?php if(isset($t->data['dateChildren'])) {echo $t->data['dateChildren'];} ?>">
      </div>
    </div>
    <div class="row padding">
      <div class="col-sm-6 padding text-right">
        <p>Введите номер школы в которой учиться ребенок (например: 37)</p>
      </div>
      <div class="col-sm-6 padding text-left">
        <?php if(isset($t->errors['schoolChildren'])) {echo '<p class="warning">' . $t->errors['schoolChildren'] . '</p><br>';} ?>
        <input type="text" name="schoolChildren" value="<?php if(isset($t->data['schoolChildren'])) {echo $t->data['schoolChildren'];} ?>">
      </div>
    </div>
    <div class="row padding">
      <div class="col-sm-6 padding text-right">
        <p>Введите класс в котором учится ребенок (например: 8)*</p>
      </div>
      <div class="col-sm-6 padding text-left">
        <?php if(isset($t->errors['classChildren'])) {echo '<p class="warning">' . $t->errors['classChildren'] . '</p><br>';} ?>
        <input type="text" name="classChildren" value="<?php if(isset($t->data['classChildren'])) {echo $t->data['classChildren'];} ?>">
      </div>
    </div>
    <div class="row padding">
      <div class="col-sm-6 padding text-right">
        <p>Введите номер телефона ребенка (формат: +79231056485)*</p>
      </div>
      <div class="col-sm-6 padding text-left">
        <?php if(isset($t->errors['phoneChildren'])) {echo '<p class="warning">' . $t->errors['phoneChildren'] . '</p><br>';} ?>
        <input type="text" name="phoneChildren" value="<?php if(isset($t->data['phoneChildren'])) {echo $t->data['phoneChildren'];} ?>">
      </div>
    </div>
    <div class="row padding">
      <div class="col-sm-6 padding text-right">
        <p>Введите email ребенка (например: ivanov@gmail.com)</p>
      </div>
      <div class="col-sm-6 padding text-left">
        <?php if(isset($t->errors['emailChildren'])) {echo '<p class="warning">' . $t->errors['emailChildren'] . '</p><br>';} ?>
        <input type="text" name="emailChildren" value="<?php if(isset($t->data['emailChildren'])) {echo $t->data['emailChildren'];} ?>">
      </div>
    </div>
    <div class="row padding">
      <div class="col-sm-6 padding text-right">
        <p>Выберите программу обучения</p>
      </div>
      <div class="col-sm-6 padding text-left">
        <?php if(isset($t->errors['programmChildren'])) {echo '<p class="warning">' . $t->errors['programmChildren'] . '</p><br>';} ?>
        <select name="programmChildren">
          <option>Выберите программу</option>
          <?php
            $i =0;
            while (isset($t->program[$i])) {
              if ($t->program[$i]['activate'] === '1') {
                if (isset($t->data['programmChildren']) && $t->data['programmChildren'] === $t->program[$i]['title']) {
                  echo '<option selected value="' . $t->program[$i]['title'] . '">' . $t->program[$i]['title'] . '</option>';
                } else {
                  echo '<option value="' . $t->program[$i]['title'] . '">' . $t->program[$i]['title'] . '</option>';
                }
              }
              $i++;
            }
          ?>
        </select>
      </div>
    </div>
    <div class="row padding">
      <div class="col-sm-12 padding text-center">
        <h4>Информация о родителе</h4>
      </div>
    </div>
    <div class="row padding">
      <div class="col-sm-6 padding text-right">
        <p>ФИО родителя*</p>
      </div>
      <div class="col-sm-6 padding text-left">
        <?php if(isset($t->errors['fioParent'])) {echo '<p class="warning">' . $t->errors['fioParent'] . '</p><br>';} ?>
        <input type="text" name="fioParent" value="<?php if(isset($t->data['fioParent'])) {echo $t->data['fioParent'];} ?>">
      </div>
    </div>
    <div class="row padding">
      <div class="col-sm-6 padding text-right">
        <p>Введите номер телефона родителя (формат: +79231056485)*</p>
      </div>
      <div class="col-sm-6 padding text-left">
        <?php if(isset($t->errors['phoneParent'])) {echo '<p class="warning">' . $t->errors['phoneParent'] . '</p><br>';} ?>
        <input type="text" name="phoneParent" value="<?php if(isset($t->data['phoneParent'])) {echo $t->data['phoneParent'];} ?>">
      </div>
    </div>
    <div class="row padding">
      <div class="col-sm-6 padding text-right">
        <p>Введите email родителя (например: ivanov@gmail.com)*</p>
      </div>
      <div class="col-sm-6 padding text-left">
        <?php if(isset($t->errors['emailParent'])) {echo '<p class="warning">' . $t->errors['emailParent'] . '</p><br>';} ?>
        <input type="text" name="emailParent" value="<?php if(isset($t->data['emailParent'])) {echo $t->data['emailParent'];} ?>">
      </div>
    </div>
    <div class="row padding">
      <div class="col-sm-12 padding text-center">
        <p>Нажимая «Подать заявку», Вы соглашаетесь с <a href="#">обработкой</a> введеных персональных данных.</p>
      </div>
    </div>
    <div class="row padding">
      <div class="col-sm-12 padding text-center">
        <input type="submit" value="Подать заявку">
      </div>
    </div>
  </form>
</div>

<!--Футер сайта-->
<?php include_once 'footer.php';
