<?php
  include_once 'header.php';
?>
  <div class="container">
    <h1><?=$t->pageTitle?></h1>
    <?php
    if (isset($t->questionComplite)) {
      echo '
        <div class="alert alert-success" role="alert">
          '.$t->questionComplite.'
        </div>
      ';
    }
    ?>
    <table class="table table-sm">
      <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col"><input type="checkbox" id="exampleCheck1"></th>
        <th scope="col">Вопрос</th>
        <th scope="col">Есть ответ</th>
        <th scope="col">Отображать в ЧАВО</th>
      </tr>
      </thead>
      <tbody>
      <?php
        $i = 0;
        while ($i <= count($t->data) -1) {
          $k = $i + 1;
          echo '
            <tr>
              <th scope="row">'.$k.'</th>
              <td><input type="checkbox" name id="exampleCheck1"></td>
              <td><a href="/adm/question/view/?id='.$t->data[$i]['id'].'">'.$t->data[$i]['question'].'</a></td>
           ';
           if ($t->data[$i]['answer'] === '') {
             echo '<td>Нет</td>';
           } else {
             echo '<td>Да</td>';
           };
           echo '
              <td><input type="checkbox" class="activeFAQ" name="showFAQ" id="'.$t->data[$i]['id'].'" value="true" 
              ';
                if ($t->data[$i]['showFAQ'] === '1') {
                  echo 'checked';
                } else {
                  echo '';
                };
           echo '
              ></td>
            </tr>
           ';
          $i++;
        }
      ?>
      </tbody>
    </table>
  </div>
<?php include_once 'footer.php';
