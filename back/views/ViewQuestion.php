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
    $i = 0;
    while ($i <= count($t->data) - 1) {
      echo '
        <div class="row">
          <div class="col">
            <h4>'.$t->data[$i]['question'].'</h4>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <p>'.$t->data[$i]['answer'].'</p>
          </div>
        </div>
        <hr>
      ';
      $i++;
    }
  ?>
  <div class="row padding">
    <div class="col">
      <form action="/question/save" method="post">
        <div class="form-row padding">
          <div class="col">
            <input type="text" class="form-control
              <?php
                if (isset($t->errors['fromAnswer'])) {
                  echo 'is-invalid';
                }
              ?>" name="fromAnswer" placeholder="Введите свое имя и отчество" value="<?=$t->data['fromAnswer'] ?? ''?>"
                                                                                                              required>
            <div class="invalid-feedback">
              <?=$t->errors['fromAnswer']?>
            </div>
          </div>
          <div class="col">
            <input type="text" name="email" class="form-control
              <?php
                if (isset($t->errors['email'])) {
                  echo 'is-invalid';
                }
              ?>" placeholder="Введите свой e-mail" value="<?=$t->data['email'] ?? ''?>" required>
            <div class="invalid-feedback">
              <?=$t->errors['email']?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="inputQuestion">Введите свой вопрос</label>
          <textarea class="form-control <?php
          if (isset($t->errors['question'])) {
            echo 'is-invalid';
          }
          ?>" id="inputQuestion" aria-describedby="emailHelp"
                    name="question" required><?=$t->data['question'] ?? ''?></textarea>
          <div class="invalid-feedback">
            <?=$t->errors['question']?>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
      </form>
    </div>
  </div>
</div>
<?php include_once 'footer.php';
