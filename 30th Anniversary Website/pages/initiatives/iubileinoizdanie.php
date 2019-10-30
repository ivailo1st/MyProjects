<?php
  require_once('../../design/title.php');

  $title = 'Юбилейно издание';

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
  <div class="span6">
    <a href="gallery/image-1.jpg" class="pic">
      <img src="gallery/image-1s.jpg" alt="" style="width: 100%;">
    </a>
  </div>

  <div class="span6">
    <a href="gallery/image-2.jpg" class="pic">
      <img src="gallery/image-2s.jpg" alt="" style="width: 100%;">
    </a>
  </div>
</div>

<div class="row">
  <div class="span6">
    <a href="gallery/image-3.jpg" class="pic">
      <img src="gallery/image-3s.jpg" alt="" style="width: 100%;">
    </a>
  </div>

  <div class="span6">
    <a href="gallery/image-4.jpg" class="pic">
      <img src="gallery/image-4s.jpg" alt="" style="width: 100%;">
    </a>
  </div>
</div>

<div class="row">
  <div class="span6">
    <a href="gallery/image-5.jpg" class="pic">
      <img src="gallery/image-5s.jpg" alt="" style="width: 100%;">
    </a>
  </div>

  <div class="span6">
    <a href="gallery/image-6.jpg" class="pic">
      <img src="gallery/image-6s.jpg" alt="" style="width: 100%;">
    </a>
  </div>
</div>

<div class="row">
  <div class="span6">
    <a href="gallery/image-7.jpg" class="pic">
      <img src="gallery/image-7s.jpg" alt="" style="width: 100%;">
    </a>
  </div>

  <div class="span6">
    <a href="gallery/image-8.jpg" class="pic">
      <img src="gallery/image-8s.jpg" alt="" style="width: 100%;">
    </a>
  </div>
</div>

<?php include ('../../design/footer.php'); ?>