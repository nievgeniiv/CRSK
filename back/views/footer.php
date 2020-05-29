<footer class="container-fluid">
  <div class="container -fluid">
    <div class="row padding text-center">
      <div class="col-12">
        <h2>Наши контакты</h2>
      </div>
    </div>
    <div class="row padding">
      <div class="col-sm-6 social padding">
        <a href="https://vk.com/club176037946"><i class="fab fa-vk"></i> </a>
      </div>
      <div class="col-sm-6 padding">
        <p>Адрес: 634050, Российская Федерация, г. Томск, пр.Ленина 34а</p>
        <p>Телефон: +7-962-778-4288</p>
        <p>e-mail: info@k21.center</p>
      </div>
    </div>
    <?php if ($t->page === 'Admin') {
      echo '
      <div class="row padding text-center">
        <div class="col-12">
          <a href="/adm/out">Выйти</a>
        </div>
      </div>';
    } else {
      echo '
      <div class="row padding text-center">
        <div class="col-12">
          <a href="/adm">Войти</a>
        </div>
      </div>';
    }?>
  </div>
</footer>
</body>
<script type="text/javascript" src="/js/ext/vue/vue.min.js"></script>
<script type="text/javascript" src="/js/ext/jQuery/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="/js/ext/jQuery/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/ext/axios/axios.min.js"></script>
<script type="text/javascript" src="/js/ext/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/ext/bootstrap/fontawesome.js"></script>
<script type="text/javascript" src="/js/asset/Settings.js"></script>
<script type="text/javascript" src="/js/ext/flatpickr/flatpickr.min.js"></script>
<script type="text/javascript" src="/js/ext/flatpickr/ru.js"></script>
<script type="text/javascript" src="/js/mod/student/Select_jQuery.js"></script>
<script type="text/javascript" src="/js/ext/lodash.min.js"></script>
<script type="text/javascript" src="/js/lib/Ajax.js?v=0.2"></script>
</html>
