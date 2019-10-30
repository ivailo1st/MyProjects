<?php
  require_once('design/title.php');

  $title = 'Фото Галерия';

  include('design/header.php');
?>

<div class="row" style="padding-bottom: 0;">
  <div class="span12">
    <h2><?php echo $title; ?></h2>
  </div>
</div>

<div class="row">
  <div class="span12">
    <?php
      if ($isLoggedIn)
        echo '<div class="row"><a href="editgallery.php" id="subtleText"><p>Редактирай галерията..</p></a></div>';

      $directory = 'gallery';
      $allowed_types = array('jpg', 'jpeg', 'gif', 'png');
      $file_parts = array();
      $ext = '';
      $title = '';
      $i = 0;

      $dir_handle = @opendir($directory) or die("There is an error with your image directory!");

      while ($file = readdir($dir_handle)) {
        if ($file=='.' || $file == '..') continue;

        $file_parts = explode('.',$file);
        $ext = strtolower(array_pop($file_parts));
        $title = htmlspecialchars(implode('.',$file_parts));

        if (in_array($ext, $allowed_types)) {
          echo '<div style="display: inline-block; float: left; width: 200px; margin-right: 1em; margin-bottom: 1em;">'.
                '<a class="pic" href="'.$directory.'/'.$file.'" data-title="'.$title.'">'.
                  '<img style="width: 100%; height: 200px;" src="'.$directory.'/'.$file.'" alt="'.$title.'"/>'.
                '</a>'.
                '</div>';

          $i++;
        }
      }

      closedir($dir_handle);
    ?>

    <div style="clear: both;"></div>
  </div>
</div>

<?php include ('design/footer.php'); ?>