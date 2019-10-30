<?php
  require_once('../../design/title.php');

  $title = 'Математика';

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
    <h3 style="padding: 0; margin: 0; font-size: 1.3em;">Списък на наградените ученици:</h3>
  </div>
</div>

<div class="row">
  <div class="span6">
    <p>
      <b>Първа възрастова група - 4 клас</b>
    </p>

    <ol type="I">
      <li>Натали Пламенова Добрева - СОУ "Васил Левски" гр.Троян  (35т.)</li>
      <li>Христо Мирославов Бойнов - НУ "Св.Св. Кирил и Методий" гр.Троян  (33т.)</li>
      <li>Ивелина Пламенова Иванова - СОУ "Св. Климент Охридски" гр.Троян (32т.)</li>
    </ol>

    <p>
      <b>Втора възрастова група - 7 клас</b>
    </p>

    <ol type="I">
      <li>Георги Светославов Генков - СОУ "Св. Климент Охридски" гр.Троян (58т.)</li>
      <li>Ивана Стелианова Буровска -  СОУ "Васил Левски" гр.Троян  (44т.)</li>
      <li>Надежда Стелянова Стефанова - СОУ "Васил Левски" гр.Троян  (43т.)</li>
    </ol>
  </div>

  <div class="span6">
    <p>
      <b>Трета възрастова група - 12 клас</b>
    </p>

    <ol type="I">
      <li>Весела Веселинова Василева - ГЧЕ "Екзарх Йосиф I" (40т.)</li>
      <li>Христина Илиева Илиева - ГЧЕ "Екзарх Йосиф I" (34т.)</li>
      <li>
        Иван Цветославов Колев -  ГЧЕ "Екзарх Йосиф I" (32т.) <br>
        Станимир Любомиров Венков -  СОУ "Васил Левски" гр.Троян  (32т.)
      </li>
    </ol>

    <p>
      <b>Поощрителна награда:</b>
    </p>

    <ul>
      <li>Виктор Ив. Иванов - СОУ "Св. Климент Охридски" гр.Троян (31т.)</li>
      <li>Ивайло Б. Чавдаров - СОУ "Васил Левски" гр.Троян  (31т.)</li>
    </ul>
  </div>
</div>

<div class="row">
  <div class="span4">
    <a href="pages/competitions/maths/1.jpg" class="pic">
      <img src="pages/competitions/maths/1.jpg" alt="" style="width: 100%;">
    </a>
  </div>

  <div class="span4">
    <a href="pages/competitions/maths/2.jpg" class="pic">
      <img src="pages/competitions/maths/2.jpg" alt="" style="width: 100%;">
    </a>
  </div>

  <div class="span4">
    <a href="pages/competitions/maths/3.jpg" class="pic">
      <img src="pages/competitions/maths/3.jpg" alt="" style="width: 100%;">
    </a>
  </div>
</div>

<?php include ('../../design/footer.php'); ?>