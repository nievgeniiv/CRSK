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
  <div class="row padding">
    <div class="col">
      <form action="/adm/question/save/?id=<?=$t->data['id']?>" method="post">
        <div class="form-row padding">
          <div class="col">
            <h3><?=$t->data['fromAnswer']?> задал(а) вопрос:</h3>
          </div>
        </div>
        <div class="form-group">
          <h4><?=$t->data['question']?></h4>
          <textarea class="form-control <?php
          if (isset($t->errors['answer'])) {
            echo 'is-invalid';
          }
          ?>" id="inputAnswer" aria-describedby="emailHelp"
                    name="answer" required><?=$t->data['answer'] ?? ''?></textarea>
          <div class="invalid-feedback">
            <?=$t->errors['answer']?>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
      </form>
    </div>
  </div>
</div>
<?php include_once 'footer.php';
