<style>
	#log_text {
		font-size: 30px;
	}
	
	#wrong {
		color: #ff0000;
	} 
</style>
<?php
	$title = 'Логин	';
	include ('design/header.php');
	$logged = @$_COOKIE['logged'];
	if ($logged) {
		header('Location: controlpanel.php');
	}
	
	
?>
<p id="log_text"><strong>Моля, логнете се:</strong></p>

<?php
if (isset($_POST['username'])) {
		$username = $_POST['username'];
		$pass = md5($_POST['pass']);
		if (!empty($username) && !empty($pass)) {
			if ($username == 'admin' && $pass == '35220eab3f3306be170facd7abed171f') {
				setcookie ('logged',2,time()+60*60);
				header('Location: controlpanel.php');
			}else {
				echo '<p id="wrong">Грешно име/парола.</p>';
			}
		}else {
			echo '<p id="wrong">Попълнете и двете полета</p>';
		}
	}
	
?>

<form action="controlpanel_login.php" method="POST">
Име: <br><input type="text" name="username" /><br><br>
Парола: <br><input type="password" name="pass" /><br><br>
<input type="submit" value="Логин">
</form><br><br><br>

<?php
	include ('design/footer.php');
?>

