<?php
include_once 'header.php';
?>
<div class="container">
<div class="row">
  <h1><?=$t->pageTitle?></h1>
</div>
<div class="row">
  <table class="table">
    <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">ФИО ребенка</th>
      <th scope="col">Класс</th>
      <th scope="col">Программа обучения</th>
      <th scope="col">ФИО родителя</th>
      <th scope="col">Телефон родителя</th>
      <th scope="col">Email родителя</th>
      <th scope="col">Дата подачи заявки</th>
      <th scope="col">Обработано</th>
      <th scope="col">Редактировать</th>
      <th scope="col">Удалить</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($t->dataInput)) {
      $i = 0;
      while ($i <= count($t->dataInput) - 1) {
        echo
        '
        <tr>
          <th scope="row">' . $t->dataInput[$i]['id'] . '</th>
          <td>' . $t->dataInput[$i]['fioChildren'] . '</td>
          <td>' . $t->dataInput[$i]['classChildren'] . '</td>
          <td>' . $t->dataInput[$i]['programmChildren'] . '</td>
          <td>' . $t->dataInput[$i]['fioParent'] . '</td>
          <td>' . $t->dataInput[$i]['phoneParent'] . '</td>
          <td>' . $t->dataInput[$i]['emailParent'] . '</td>
          <td>' . $t->dataInput[$i]['date'] . '</td>';
        if ($t->dataInput[$i]['complite'] === '1') {
          echo '<td>Обработано</td>';
        } else {
          echo '<td><button class="btn btn-danger compliteBtn" id="' . $t->dataInput[$i]['id'] . '">Обработать</button></td>';
        }
        echo '
          <td><a href="/adm/programms/viewChildren/?edit=1&id=' . $t->dataInput[$i]['id'] . '">
          <img src="/img/pen.png" width="20"></a></td>
          <td><img class="deleteChildren" id="' . $t->dataInput[$i]['id'] . '" src="/img/trash.jpg" width="20"></td>
        </tr>';
        $i++;
      }
    }?>
    </tbody>
  </table>
</div>
</div>
<!--Футер сайта-->
<?php include_once 'footer.php';
