<?php
  require_once('../../design/title.php');

  $title = 'Децата рисуваха и правиха чорапени човечета';

  include('../../design/header.php');
?>

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
  <div class="span12">
    <p>
      Наградени участници в конкурса за изработване на чорапени човечета:
    </p>

    <ol type="I">
      <li>Габриела Иванова Павлова – 2.а клас</li>
      <li>Ния Любомирова Пауникова – 5.б клас</li>
      <li>Евдокия Делянова Джиговска – 2.а клас</li>
    </ol>

    <p>
      Наградени участници в конкурса за рисунка на тема „Моето училище”, подготвителна група – 4. клас:
    </p>

    <ol type="I">
      <li>Моника Цветанова Монкова – 3.а клас</li>
      <li>Йосиф Дочев Илиев – 4.а клас</li>
      <li>Виктория Веселинова Николова – 1.б клас</li>
      <li>Сиана Делянова Енчевска – подготвителна група</li>
    </ol>

    <p>
      5. - 8. клас:
    </p>

    <ol type="I">
      <li>Иван Стефанов Стефанов – 6.в клас</li>
      <li>Никол Мирославова Илиева – 6.б клас</li>
      <li>Мария Сергеева Георгиева – 5.а клас</li>
    </ol>
  </div>
</div>

<?php include ('../../design/footer.php'); ?>