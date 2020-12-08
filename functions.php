<?php
	$dbhost='localhost';
	$dbname='aasimsnesting';
	$dbuser='root';
	$dbpass='arshad10khan';
	$appname="SocialShare";
	
	$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
	if($connection->connect_error) die($connection->connect_error);
	
	function createTable($name, $query)
	{
		queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
		echo "Table '$name' created or already exists.<br>";
	}
	function queryMysql($query)
	{
		global $connection;
		$result = $connection->query($query);
		if(!$result) die($connection->error);
		return $result;
	}
	function destroySession()
	{
		$_SESSION=array();
		
		if(session_id() !="" || isset($_COOKIE[session_name()]))
			setcookie(session_name(), '',time()-2592000,'/');
		session_destroy();
	}
	function sanitizeString($var)
	{
		global $connection;
		$var = strip_tags($var);
		$var = htmlentities($var);
		$var = stripslashes($var);
		return $connection->real_escape_string($var);
	}
	function showProfile($user)
	{
		if(file_exists("user.jpg"))
			echo "<div class='display_profile'><img src='user.jpg' style='float:left;'><br><br><br>";
		else
		{
			echo "No file";
		}
		$result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
		
		if($result->num_rows)
		{
			$row=$result->fetch_array(MYSQLI_ASSOC);
			echo "<br><br><br><br><br><br><div class='prey'>".stripslashes($row['text']). "<br style='clear:left;'><br></div></div>";
		}
	}
	
	
	

?>