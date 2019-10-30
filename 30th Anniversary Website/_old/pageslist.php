<style>
#header {
		font-size: 30px;

	}
	
.file {
		text-decoration: none;
		color: #777777;
	} 

.file:hover {
		color: #999999;
		text-decoration: underline;
	}
</style>

<?php
	$title = 'Списък със страници';
	include('design/header.php');
?>

<p id="header"><strong>Списък със страници:</strong></p>
<?php
	foreach(glob('*.php') as $file) {
		echo '<a href="'.$file.'" class="file">'.$file.'</a><br>';
	}
	echo '<br><br>';
	include('design/footer.php');
?>
