<?php
	$postID = $_GET['postID'];
	$logged = @$_COOKIE['logged'];
	if ($logged) {
		unlink('posts/'.$postID.'.php');
		header('Location: index.php');
	}else {
		header('Location: index.php');
	}
?>