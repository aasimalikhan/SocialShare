<?php
	require_once 'header.php';
	
	echo <<<_END
		<script>
		function checkUser(user)
		{
			if(user.value == '')
			{
				O('info').innerHTML = ''
				return
			}
			
			params = "user=" +user.value
			request = new ajaxRequest()
			request.open("POST","checkuser.php",true)
			request.setRequestHeader("Content-type","application/x-www-form-urlencoded")
			request.setRequestHeader("Connection","close")
			
			request.onreadystatechange = function()
			{
				if(this.readyState == 4)
					if(this.status == 200)
						if(this.responseText != null)
							O('info').innerHTML = this.responceText
			}
			request.send(params)
		}
		function ajaxRequest()
		{
			try { var request = new XMLHttpRequest() }
			catch(e1) {
				try{ request = new ActiveXObject("Msxml2.XMLHTTP") }
				catch(e2) {
					try { request = new ActiveXObject("Microsoft.XMLHTTP") }
					catch(e3) {
						request = false
					}
				}
			}
			return request
		}
		</script>
		<div class='prey'>Please enter your details to sign up</div><br>
_END;
		
		$error = $user = $pass ="";
		if(isset($_SESSION['user'])) destroySession();
		
		if(isset($_POST['user']))
		{
			$user = sanitizeString($_POST['user']);
			$pass = sanitizeString($_POST['pass']);
			
			if($user == "" || $pass == "")
				$error = "<span class='error'>Not all fields were entered</span><br><br>";
			else
			{
				$result = queryMysql("SELECT * FROM members WHERE user='$user'");
				
				if($result->num_rows)
					$error ="<span class='error'>That username already exists</span><br><br>";
				else{
					queryMysql("INSERT INTO members VALUES('$user','$pass')");
					die("<span class='textbasic'>Account created</span><br><span class='textbasic'>Please Log in.</span><br>");
					
				}
			}
		}
		echo <<<_END
			<form method='post' action='signup.php'>$error
			<span class='preym'>Username</span>
			<input type='text' class='bruhh' maxlength='16' name='user' value='$user'
				onBlur='checkUser(this)'<span id='info'></span><br>
			<span class='preym'>Password</span>
			<input class='bruhh' type='text' maxlength='16' name='pass' value='$pass'><br>
_END;
?>
		<span class='fieldname'>&nbsp;</span>
		<input class='button3' type='submit' value='Sign up'>
		</form></div><br>
	</body>
</html>
		
			
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		