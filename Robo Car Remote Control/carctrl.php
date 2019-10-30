<!DOCTYPE html>
<html>
<body>

<h1>
<?php
if(isset($_GET['F'])){
        $msg = shell_exec("echo F >/var/www/html/carctrl.txt");
        echo "Forward";
}
else if(isset($_GET['B1F'])){
	$msg = shell_exec("echo B1F >/var/www/html/carctrl.txt");
	echo "Button 1 Forward";
}
else if(isset($_GET['B2F'])){
	$msg = shell_exec("echo B2F >/var/www/html/carctrl.txt");
	echo "Button 2 Forward";
}
else if(isset($_GET['FF'])){
        $msg = shell_exec("echo FF >/var/www/html/carctrl.txt");
        echo "Fast Forward";
}
else if(isset($_GET['B1FF'])){
	$msg = shell_exec("echo B1FF >/var/www/html/carctrl.txt");
	echo "Button 1 Fast Forward";
}
else if(isset($_GET['B2FF'])){
	$msg = shell_exec("echo B2FF >/var/www/html/carctrl.txt");
	echo "Button 2 Fast Forward";
}
else if(isset($_GET['S'])){
        $msg = shell_exec("echo S >/var/www/html/carctrl.txt");
        echo "Stop";
}
else if(isset($_GET['B1S'])){
	$msg = shell_exec("echo B1S >/var/www/html/carctrl.txt");
	echo "Button 1 Stop";
}
else if(isset($_GET['B2S'])){
	$msg = shell_exec("echo B2S >/var/www/html/carctrl.txt");
	echo "Button 2 Stop";
}
?>

</h1>




<h2>Basic HTML Table</h2>

<form action="/carctrl.php" method="get" >
	<table border=3 >
	  <tr>
	    	<td>
		<input type="submit" value="B1FF" name="B1FF">
		</td>
	    	<td style="text-align:center">
		<input type="submit" value="Fast_Forward" name="FF">
		</td>
	    	<td>
		<input type="submit" value="B2FF" name="B2FF">
		</td>
	  </tr>
	  <tr>
	    	<td>
		<input type="submit" value="B1F" name="B1F" style="width:100%">
		</td>
	    	<td style="text-align:center">
		<input type="submit" value="Forward" name="F" style="width:100%">
		</td>
	    	<td>
		<input type="submit" value="B2F" name="B2F" style="width:100%">
		</td>
	  </tr>
	  <tr>
	    	<td>
		<input type="submit" value="B1S" name="B1S" style="width:100%">
		</td>
	    	<td style="text-align:center">
		<input type="submit" value="Stop" name ="S" style="width:100%">
		</td>
	    	<td>
		<input type="submit" value="B2S" name="B2S" style="width:100%">
		</td>
	  </tr>
	</table>
</form> 


</body>
</html>


