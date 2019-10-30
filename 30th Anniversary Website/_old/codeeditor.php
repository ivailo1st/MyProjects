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
			
			<?php
				$path = $_GET['path'];
				if (!$path) {
					echo 'wtf we brat';
					die();
				}
			?>
			<span id="header"><strong>Редактиране на код:</strong></span><br><br>
			
			<?php
				if (isset($_POST['code'])) {
					$code = stripslashes($_POST['code']);
					$code = str_replace('\"','"',$code);
					$handle = fopen($path, 'w+');
					if (fwrite($handle, $code)) {
						echo 'Успешно запазихте промените!';
					}else {
						echo 'Нещо се обърка, промените не са запазени:<br>';
					}
				}
			?>
			
			<form method="POST" action="codeeditor.php?path=<?php echo $path; ?>">
			<textarea rows="15" cols="70" name="code"><?php echo file_get_contents($path); ?></textarea><br><br>
			<input type="submit" value="Запази" />
			</form>
			
			
			<?php
			include ('design/footer.php');
			?>
			