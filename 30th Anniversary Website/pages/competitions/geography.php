<?php
  require_once('../../design/title.php');

  $title = 'География';

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
    <p style="float: left; width: 25%; margin-right: 1em;">
      <a href="pages/competitions/geography/1.jpg" class="pic">
        <img src="pages/competitions/geography/1.jpg" alt="" style="width: 100%;">
      </a>
    </p>

    <p>
      На 16 октомври 14 ученици от 12.а клас се явиха на състезание по география, проведено във формата на матурата за тази дисциплина.
    </p>

    <p>
      Бъдещите зрелостници са се представили много добре, а най-висок резултат е показала Емили Недялкова.
    </p>

    <p>
      Тази година възможността 12-класниците масово да се пробват на примерен зрелостен изпит по география е в рамките на училищната Седмица на Земята.
    </p>
  </div>
</div>

<?php include ('../../design/footer.php'); ?>