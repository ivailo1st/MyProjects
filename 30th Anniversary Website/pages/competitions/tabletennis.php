<?php
  require_once('../../design/title.php');

  $title = 'Тенис на маса';

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

<div class="row" style="padding-bottom: 0;">
  <div class="span12">
    <p>
      На 7 октомври, вторник, във физкултурния салон на училището се проведе състезанието по тенис на маса.
    </p>

    <h3 style="padding: 0; margin: 0; font-size: 1.3em;">Ето класирането: </h3>
  </div>
</div>

<div class="row">
  <div class="span6">
    <p>
      <b>Група 3.-4. клас</b>
    </p>

    <ol type="I">
      <li>Тервел Бажанов</li>
      <li>Камен Миндев</li>
    </ol>

    <p>
      <b>Група 5. клас, момчета</b>
    </p>

    <ol type="I">
      <li>Людмил Кулчев</li>
      <li>Петър Йовевски</li>
      <li>Андрей Иванов</li>
    </ol>

    <p>
      <b>Група 5. клас, момичета</b>
    </p>

    <ol type="I">
      <li>Ния Пауникова</li>
      <li>Виктория Иванова</li>
      <li>Вероника Стефанова</li>
    </ol>
  </div>

  <div class="span6">
    <p>
      <b>Група 6. клас</b>
    </p>

    <ol type="I">
      <li>Михаил Геров</li>
      <li>Мадлен Маркова</li>
    </ol>

    <p>
      <b>Група 6. клас</b>
    </p>

    <ol type="I">
      <li>Любомир Кирилов</li>
      <li>Михаил Бакрев</li>
      <li>Венцислав Камарашки</li>
    </ol>
  </div>
</div>

<div class="row">
  <div class="span6">
    <a href="pages/competitions/tabletennis/1.jpg" class="pic">
      <img src="pages/competitions/tabletennis/1.jpg" alt="" style="width: 100%;">
    </a>
  </div>

  <div class="span6">
    <a href="pages/competitions/tabletennis/2.jpg" class="pic">
      <img src="pages/competitions/tabletennis/2.jpg" alt="" style="width: 100%;">
    </a>
  </div>
</div>

<?php include ('../../design/footer.php'); ?>