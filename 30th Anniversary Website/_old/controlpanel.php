<style>
	#logout{
		float:right;
		font-size:23px;
		color: #ff8c00;
	}
	#logout:hover {
		color: #ffae00;
		text-decoration: underline;
	}

	#header {
		font-size: 30px;

	}
	
	#wrong {
		color: #ff0000;
	} 
	
	#smallLink {
		color: #aaaaaa;
		font-size:12px;
		font-style: italic;
		text-decoration:none;
	}
	
	#smallLink:hover {
		color: #555555;
	}
	
	#smallLink2 {
		color: #ff8c00;
		font-size:14px;
		font-style: italic;
		text-decoration:none;
	}
	
	#smallLink2:hover {
		color: #ffac00;
		text-decoration: underline;
	}
	
	.link1 {
		text-decoration: underline;
	}
</style>

<?php
	$title = 'Контролен панел';
	include('design/header.php');
	$logged = @$_COOKIE['logged'];
	if (!$logged) {
		header('Location: cp.php');
		die();
	}


?>
<a href="logout.php" id="logout">Изход</a>

<span id="smallLink">Допълнителни линкове:</span> <a href="codeeditor_set.php" id="smallLink2">редактиране на код</a><br><br>

<span id="header"><strong>Създаване на нова страница:</strong></span>

<?php
	if (isset($_POST['pagename'])) {
		$pagename = $_POST['pagename'];
		$filename = $_POST['filename'];
		$newPageContent = $_POST['content'];
		$addmenu = @$_POST['addmenu'];
		if (!empty($pagename) && !empty($filename)) {
			// dobavqne kum menuto
			if ($addmenu == 'add') {
				$pagename = str_replace(' ','',$pagename);
				$oldmenu = file_get_contents('design/menu.php');
				$handle = fopen('design/menu.php','a');
				$newcontent = '
				<li><a href="'.$filename.'.php" id="link">'.$pagename.'</a></li>';
				if (fwrite($handle, $newcontent)) {
					echo 'Страницата успешно добавена в менюто!<br>';
				}else {
					echo 'Нещо се обърка, страницата не е добавена в менюто!<br>';
				} 
			}
			// suzdavane na samata stranica
			$handleNew = fopen("".$_SERVER['DOCUMENT_ROOT']."/".$filename.".php","w");
			$finalContentNewPage = '
			<?php
			$title = \''.$pagename.'\';
			include(\'design/header.php\');
			?>
			'.$newPageContent.'
			<?php
			include (\'design/footer.php\');
			?>
			';
			$finalContentNewPage = stripslashes($finalContentNewPage);
			if (fwrite($handleNew,$finalContentNewPage)) {
				echo 'Успешно създадохте нова страница!';
			}else {
				echo 'Нещо се обърка, страницата не е създадена!';
			}
			
		}else {
			echo '<p id="wrong">Попълнете всички полета!</p>';
		}
	}
?>
<br>
<form action="controlpanel.php" method="POST">
Име на страницата:<br>
<input type="text" name="pagename"><br><br>
Име на файла:<br>
<input type="text" name="filename">.php<br><br>
Съдържание:<br>
<textarea rows="7" cols="70" name="content"></textarea><br><br>
<input type="checkbox" name="addmenu" value="add">
добави към менюто<br><br>
<input type="submit" value="Създай">
</form><br>

<span id="header"><strong>Премахване на страница:</strong></span><br>
<a id="smallLink" href="pageslist.php" target="_blank">Списък със страници..</a><br><br>

<?php
	if (isset($_POST['pagenameDel'])) {
		$pagenameDel = $_POST['pagenameDel'];
		$filenameDel = $_POST['filenameDel'];
		if (!empty($pagenameDel) && !empty($filenameDel)) {
			$menuContent = file_get_contents('design/menu.php');
			$line = '<li><a href="'.$filenameDel.'.php" id="link">'.$pagenameDel.'</a></li>';
			$menuContent = str_replace($line,'',$menuContent);
			if (file_put_contents('design/menu.php',$menuContent)) {
				echo 'Страницата успешно премахната от менюто!<br>';
			}else {
				echo 'Нещо се обърка, страницата не е премахната от менюто!<br>';
			}
			if (unlink($filenameDel.'.php')) {
				echo 'Страницата успешно изтрита!';
			}else {
				echo 'Нещо се обърка, страницата не е изтрита!';
			}
		}else {
			echo '<p id="wrong">Попълнете всички полета!</p>';
		}
	}	
	
?>

<form action="controlpanel.php" method="POST">
Име на страницата:<br>
<input type="text" name="pagenameDel"><br><br>
Име на файла:<br>
<input type="text" name="filenameDel">.php<br><br>
<input type="submit" value="Изтрий">
</form><br>

<span id="header"><strong>Създаване на нова публикация:</strong></span><br>

<?php
	if (isset($_POST['postTitle'])) {
		$postTitle = $_POST['postTitle'];
		$postID = $_POST['postID'];
		$postContent = $_POST['postContent'];
		if (!empty($postTitle) && !empty($postID)) {
			$postHandle = fopen('posts/'.$postID.'.php','w');
			$post = ' 
			<?php $postTitle = \''.$postTitle.'\'; ?>
			<article class="row">
                        <div class="span12">
                             <a href="postreader.php?postID='.$postID.'" id="postTitle"><h3>'.$postTitle.'</h3></a>
                             <p>'.$postContent.'
                                
                             </p>
                        </div>
                    </article>';
			$post = stripslashes($post);
			if (fwrite($postHandle,$post)) {
				echo 'Публикацията успешно качена!';
			}
			
			// include 
			$oldPostInclude = file_get_contents('posts.php');
			$postInclude = '
<?php @include_once \'posts/'.$postID.'.php\'; ?>'.$oldPostInclude;
			$postIncludeHandle = fopen('posts.php','r+');
			if (fwrite($postIncludeHandle, $postInclude)) {
				
			}else {
				echo 'Нещо се обърка!';
			}
		}else {
			echo '<p id="wrong">Попълнете всички полета!</p>';
		} 
	}
?>

<form action="controlpanel.php" method="POST">
Заглавие на публикацията:<br>
<input type="text" name="postTitle"><br><br>
ID на публикацията:<br>
<input type="text" name="postID"><br><br>
Съдържание:<br>
<textarea name="postContent" rows="7" cols="70"></textarea><br><br>
<input type="submit" value="Публикувай">
</form>