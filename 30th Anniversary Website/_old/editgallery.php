<style>
	.echoFile {
		text-decoration: none;
		color: black;
	} 
	
	.delButton {
		color: red;
		text-decoration:none;
	}
</style>
			<?php
			$title = 'Редактиране на галерията';
			include('design/header.php');
			?>
			
			<?php
				if ($logged) {
					
				}else {
					header("Location: index.php");
					die();
				} 
				
				$name = @$_FILES['file']['name'];
				$fileTitle = @$_POST['title'];
				$rand = rand(1,9999999);
				$rand2 = rand($rand, 9999999999999999);
				if (!$fileTitle) {
					$fileTitle = md5($rand2);
				}else {
					$fileTitle = str_replace(' ','_',$fileTitle);
				} 
				$extension = substr($name, -4);
				$size = @$_FILES['file']['size'];
				$type = @$_FILES['file']['type'];
				$tmp_name = @$_FILES['file']['tmp_name'];
				$error = @$_FILES['file']['error'];
				$location = 'gallery/';
				$finalDestination = $location.$fileTitle.$extension;
				
				if (isset($name)) {
					if (!empty($name)) {
					if ($type == 'image/jpeg' || $type == 'image/png') {
							if (move_uploaded_file($tmp_name, $finalDestination)){
								include("SimpleImage.php");
								$image = new SimpleImage();
								$image->load($finalDestination);
								$image->resizeToWidth(500);
								$image->save($finalDestination);
								echo 'Файлът качен успешно!<br><br>';
							}else {
								echo $error;
							}
						}else {
							echo 'Невалиден формат!<br><br>';
						}
					}else {
						echo 'Моля, изберете файл!<br><br>';
					} 
				}
			?>
			
			<form method="POST" action="editgallery.php" enctype="multipart/form-data">
				Изберете снимка за качване:<br>
				<input type="file" name="file"><br><br>
				Изберете заглавие на снимката:<br>
				<input type="text" name="title"><br><br>
				<input type="submit" value="Качи">
			</form>
			
			
			<?php
				foreach(glob('gallery/*.*') as $file) {
					$echoFile = str_replace('gallery/','','<a href="imgdeleter.php?imgname='.$file.'" class="delButton">X </a><a href="'.$file.'" class="echoFile">'.$file.'</a><br>');
					echo $echoFile;
				}
			?>
			
			<?php
			include ('design/footer.php');
			?>
			