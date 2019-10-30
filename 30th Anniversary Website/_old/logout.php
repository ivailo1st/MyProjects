<?php
	setcookie ('logged',2,time()-3600*3600);
	header("Location: index.php");
?>