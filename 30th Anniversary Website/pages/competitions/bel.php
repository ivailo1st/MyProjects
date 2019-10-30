<?php
  require_once('../../design/title.php');

  $title = 'Български език и литература';

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
    <p style="float: left; margin-right: 1em; width: 25%;">
      <a href="pages/competitions/bel/1.jpg" class="pic">
        <img src="pages/competitions/bel/1.jpg" alt="" style="width: 100%;">
      </a>
    </p>

    <p>
      На 4 ноември се проведе състезание по български език и литература.
      То включваше задачи за проверяване на функционалната грамотност и за написване на есе,
      а 12-класниците имаха възможност да се пробват на тест с формата на матурата.Вижте победителите в отделните възрастови групи.
    </p>
  </div>
</div>

<div class="row">
  <div class="span12">
    <p>
      <b>ПОБЕДИТЕЛИ В ОТДЕЛНИТЕ ВЪЗРАСТОВИ ГРУПИ:</b>
    </p>
  </div>
</div>

<div class="row">
  <div class="span6">
    <p>
      <b>7. клас</b>
    </p>

    <ol type="I">
      <li>Дениса Танкова, 7.б клас</li>
      <li>Ния Чонова, 7. а клас</li>
      <li>Кристиян Димитров, 7.а клас</li>
    </ol>

    <p>
      <b>8. – 9. клас</b>
    </p>

    <ol type="I">
      <li>Кольо Петров, 10.а клас</li>
      <li>Борис Иванов и Калоян Кюркчиев, 10. а клас</li>
      <li>Памела Монева, 11.б клас</li>
    </ol>
  </div>

  <div class="span6">
    <p>
      <b>12. клас</b>
    </p>

    <ol type="I">
      <li>Стефания Калева, 12.а клас</li>
      <li>Ивелина Ямелиева, 12.а клас</li>
      <li>Силвия Лазарова, 12.а клас</li>
    </ol>
  </div>
</div>

<?php include ('../../design/footer.php'); ?>