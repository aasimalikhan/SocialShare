<?php
	require_once 'header.php';
	echo "<div class='preym'>Please enter your detais to log in</div>";
	$error=$user=$pass="";
	if(isset($_POST['user']))
	{
		$user = sanitizeString($_POST['user']);
		$pass = sanitizeString($_POST['pass']);
		
		if($user == "" || $pass =="")
			$error="<span class='error'>Not all fields were entered</span><br>";
		else
		{
			$result = queryMysql("SELECT user,pass FROM members
				WHERE user='$user' AND pass='$pass'");
				
			if($result->num_rows == 0)
			{
				$error = "<span class='error'>Username/Password
							invalid</span><br><br>";
			}
			else
			{
				$_SESSION['user']=$user;
				$_SESSION['pass']=$pass;
				die("<div class='preybruh'>You are now logged in. Please <a class='meowpilli' href='members.php?view=$user'>" .
					"click here</a> to continue</span><br><br>");
			}
		}
	}
	echo <<<_END
		<form method='post' action='login.php'>$error
		 <span class='preym'>Username</span><input class='bruhh' type='text'
		 maxlength='16' name='user' value='$user'><br>
		 <span class='preym'>Password</span><input class='bruhh' type='password'
		 maxlength='16' name='pass' value='$pass'>
_END;
?>

	<br>
	<span class='fieldname'>&nbsp;</span>
	<input class='button3' type='submit' value='Login'>
	</form><br></div>
</body>
</html>