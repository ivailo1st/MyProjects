<?php
  require_once('../../design/title.php');

  $title = 'Волейбол';

  include('../../design/header.php');
?>

<div class="row">
  <div class="span12">
    <a href="pages/sustezaniq.php" class="btn"><< Обратно</a>
  </div>
</div>

<div class="row" style="padding-bottom: 0;">
  <div class="span12">
    <h2><?php echo $title; ?></h2>
  </div>
</div>

<div class="row">
  <div class="span12">
    <p>
      В състезанието по волейбол, проведено на 9 октомври, победител е отборът на 11.а клас в състав: <br>
      Божидар Бочев, Кристиян Стефанов, Илиян Илиев, Любомир Кирилов, Максун Бекиров, Айхан Асанов, Христо Маргинов, Хатъф Толев.
    </p>
  </div>
</div>

<div class="row">
  <div class="span6">
    <a href="pages/competitions/volleyball/1.jpg" class="pic">
      <img src="pages/competitions/volleyball/1.jpg" alt="" style="width: 100%;">
    </a>
  </div>

  <div class="span6">
    <a href="pages/competitions/volleyball/2.jpg" class="pic">
      <img src="pages/competitions/volleyball/2.jpg" alt="" style="width: 100%;">
    </a>
  </div>
</div>

<?php include ('../../design/footer.php'); ?>