<?php
	include ('design/header.php');
	if ($logged) {
		$imgname = $_GET['imgname'];
		if(unlink('gallery/'.$imgname)) {
			header("Location: editgallery.php");
		}else {
			echo 'Снимката не можа да бъде изтрита!';
		} 
	}else {
		header("Location: index.php");
		die();
	} 
	include ('design/footer.php');
?>