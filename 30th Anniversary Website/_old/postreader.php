<style>
#subtleText {
	color: #888888;
	text-decoration: none;
	font-style:italic;
	font-size: 12px;
}

#subtleText:hover {
	color: #aaaaaa;
}
</style>


			<?php
			include('design/header_alt.php');
			?>
			
			<?php
				$postID = $_GET['postID'];
				$logged = @$_COOKIE['logged'];
				if ($logged) {
					echo '<a href="postdeleter.php?postID='.$postID.'" id="subtleText">Изтрий публикацията</a>';
				}
				include ('posts/'.$postID.'.php');
				include ('design/title.php');
			
			?>
			
			<?php
			include ('design/footer.php');
			?>
			