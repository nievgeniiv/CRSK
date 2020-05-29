<?php
include_once TEMPLATES . 'header.php';
?>

  <h1><?= $t->pageTitle?></h1>
  <div>
    <form action="/adm/do/" method="POST">
      <?php if (isset($t->loginError)) {echo 'Неверный логин или пароль</br>';}?>
      <input type="text" name="username" title="Имя пользователя" required>
      <input type="password" name="passwd" title="Пароль" required>
      <input type="submit" value="Войти">
    </form>
  </div>


<?php include_once TEMPLATES . 'footer.php'; ?>