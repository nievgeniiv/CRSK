<?php
include_once 'header.php';
?>
  <div class="container-fluid padding">
<div class="row alert text-center">
  <div class="col-12">
    <h1 class="display-4"><?=$t->pageTitle?></h1>
  </div>
</div>
  <div class="container padding">
  <div class="row" id="parent">
    <?php
      $i = 0;
      while ($i <= count($t->dataInput) -1) {
        if ($i % 2 === 0) {
          echo '
            <div class="row padding">
              <div class="col-md-6">
                <div class="card">
                  <img src="' . $t->dataInput[$i]['image'] . '" class="card-img-top">
                  <div class="card-body">
                    <h4 class="card-title">' . $t->dataInput[$i]['title'] . '</h4>
                    <button type="button" id="gifsBtn" class="btn btn-success" 
                    data-toggle="collapse" data-target="#text' . $t->dataInput[$i]['id'] . '" >Подробнее</button>
                  </div>
                </div>
              </div>';
        } else {
          echo '
            <div class="col-md-6">
              <div class="card">
                <img src="' . $t->dataInput[$i]['image'] . '" class="card-img-top">
                <div class="card-body">
                  <h4 class="card-title">' . $t->dataInput[$i]['title'] . '</h4>
                  <button type="button" id="gifsBtn" class="btn btn-success" 
                  data-toggle="collapse" data-target="#text' . $t->dataInput[$i]['id'] . '">Подробнее</button>
                </div>
              </div>
            </div>
          </div>
          <div id="text' . $t->dataInput[$i-1]['id'] . '" class="collapse" data-parent="#parent">
            <div class="contaner-fluid">
              <div class="row jumbotron">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-12">
                  ' . $t->dataInput[$i-1]['description'] . '
                </div>  
              </div>
            </div>
          </div>
          <div id="text' . $t->dataInput[$i]['id'] . '" class="collapse" data-parent="#parent">
            <div class="contaner-fluid">
              <div class="row jumbotron">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
                  ' . $t->dataInput[$i]['description'] . '
                </div>
              </div>
            </div>
          </div>
          ';
        }
        $i++;
      }
      if (($i-1) % 2 === 0) {
        echo '
        </div>
          <div id="text' . $t->dataInput[$i-1]['id'] . '" class="collapse" data-parent="#parent">
            <div class="contaner-fluid">
              <div class="row jumbotron">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
                  ' . $t->dataInput[$i-1]['description'] . '
                </div>
              </div>
            </div>
          </div>';
      }
    ?>
  </div>
  </div>
</div>
<!--Футер сайта-->
<?php include_once 'footer.php';
