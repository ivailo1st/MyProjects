<?php
  require_once('../design/title.php');

  $title = 'Състезания';

  include('../design/header.php');
?>

<div class="row" style="padding-bottom: 0;">
  <div class="span12">
    <h2><?php echo $title; ?></h2>
  </div>
</div>

<div class="row">
  <div class="span12">
    <ul id="links">
      <li>
        <a href="pages/competitions/azgovorqna.php">Аз говоря на</a>
      </li>

      <li>
        <a href="pages/competitions/basketball.php">Баскетбол</a>
      </li>

      <li>
        <a href="pages/competitions/bel.php">Български език и литература</a>
      </li>

      <li>
        <a href="pages/competitions/volleyball.php">Волейбол</a>
      </li>

      <li>
        <a href="pages/competitions/geography.php">География</a>
      </li>

      <li>
        <a href="pages/competitions/debatenglish.php">Дебат по английски</a>
      </li>

      <li>
        <a href="pages/competitions/it.php">Информационни технологии</a>
      </li>

      <li>
        <a href="pages/competitions/history.php">История за петокласниците</a>
      </li>

      <li>
        <a href="pages/competitions/maths.php">Математика</a>
      </li>

      <li>
        <a href="pages/competitions/swimming.php">Плуване</a>
      </li>

      <li>
        <a href="pages/competitions/otgovornost.php">Споделена отговорност към уникалните гори в Троянския Балкан</a>
      </li>

      <li>
        <a href="pages/competitions/sportsgames.php">Спортни игри за най-малките</a>
      </li>

      <li>
        <a href="pages/competitions/tabletennis.php">Тенис на маса</a>
      </li>
    </ul>
  </div>
</div>

<?php include ('../design/footer.php'); ?>