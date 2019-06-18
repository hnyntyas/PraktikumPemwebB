<?php
session_start();

if(!empty($_SESSION["unm"])){
	header("Location: home.php");
	exit;
}

if(isset($_POST["submit1"])){
	// mysql_connect("localhost","root","pwd");
	// mysql_select_db("login");
	// $res=mysql_query("select * from table1 where username='$_POST[text1]' && pwd='$_POST[text2]'");
	// while($row=mysql_fetch_array($res)){
	$_SESSION["unm"]='a';
		// $_SESSION["unm"]=$row["username"];
	// }

	header("Location: home.php");
	exit;
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Management File</title>
<link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
	<div class="form1">
			<form name="form1" action="" method="post">
			Enter Username   <input type="text" name="text1"><br><br>
			Enter Password    <input type="password" name="text2"><br><br>
			<input style="margin-left:105px;" type="submit" name="submit1" value="login">
			</form>
	</div>
</body>

</html>
