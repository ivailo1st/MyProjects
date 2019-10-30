<?php
  require_once('../../design/title.php');

  $title = '30 метрова рисунка';

  include('../../design/header.php');
?>

<div class="row">
  <div class="span12">
    <div class="row">
      <div class="span12">
        <a href="pages/iniciativi.php" class="btn"><< Обратно</a>
      </div>
    </div>

    <div class="row" style="padding-bottom: 0;">
      <div class="span12">
        <h2><?php echo $title; ?></h2>
      </div>
    </div>

    <div class="row">
      <p class="span12">
      На 20 октомври деца от подготвителната група и от начален курс (1.-4. клас) нарисуваха 30-метрова рисунка по повод 30-годишнината на нашето любимо училище. Това се случи около ореховото дърво в двора. Децата бяха весели и развълнувани.
      </p>
    </div>

    <div class="row">
      <a class="pic span6" href="gallery/b437928c220938abd3b39900d7e8ea17.jpg">
        <img src="gallery/b437928c220938abd3b39900d7e8ea17.jpg" style="width:100%" />
      </a>

      <a class="pic span6" href="gallery/c77285644847839e55074c4ef47730c9.jpg">
        <img src="gallery/c77285644847839e55074c4ef47730c9.jpg" style="width:100%"/>
      </a>
    </div>

  </div>
</div>

<?php include ('../../design/footer.php'); ?>