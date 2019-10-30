			<style>
			
			#header {
			font-size: 30px;

			}
			</style>

			<?php
			$title = 'Редактиране на код';
			include('design/header.php');
			if (!$logged) {
				header('Location: cp.php');
				die();
			}
			?>
			
			<span id="header"><strong>Редактиране на код:</strong></span><br><br>
			
			<?php
			
			if (isset($_POST['file'])) {
			$file = $_POST['file'];
				if (!empty($file)) {
					$path = 'codeeditor.php?path='.$file;
					header('Location: '.$path);
				}else {
					echo 'Моля, изберете файл!';
				}
			}
			
			?>
			
			<form method="POST" action="codeeditor_set.php">
			Изберете файл за редактиране:<br><br>
			<input type="text" name="file"><br><br>
			<input type="submit" value="Редактирай">
			</form>
			
			<?php
			include ('design/footer.php');
			?>
			