<?php 	

function connectToDb()
{
	$host = "localhost"; // Host name 
	$username = "gtisgooduser"; // Mysql username
	$password = "password"; // Mysql password 
	$db = "gtisgood"; // Database name
	
	// Connect to server and select databse.
	$con = mysql_connect($host, $username, $password) or die('Could not connect. Go to <a href="adminLogin.php" class="links">Login Page</a>.');
	mysql_select_db("$db")or die('Cannot select DB. Go to <a href="adminLogin.php" class="links">Login Page</a>.');
	return $con;
}

function breakCon($con)
{
	return mysql_close($con);
}

function desql($sql)
{
	// I have no idea why these are here... but this is how 
	// you include global variables if needed.
	// global $tbl1, $tbl2, $tbl3, $tbl4, $tbl5, $tbl6;
	// global $frm1, $frm2;
	$sql = stripslashes($sql);
//	$sql = mysql_real_escape_string($sql); 
	return mysql_query($sql);
}

function desql_print($sql)
{
	$result = desql($sql);
	if(mysql_num_rows($result) > 0)
	{
		echo "<pre>";
		while($row = mysql_fetch_array($result))
		{
			print_r($row);
			echo "<br />";
		}
		echo "</pre>";
	}
}
?>
