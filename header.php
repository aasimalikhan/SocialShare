<?php
	session_start();
	echo "<!DOCTYPE html>\n<html><head>";
	
	require_once 'functions.php';
	$userstr ='(Guest)';
	
	if(isset($_SESSION['user']))
	{  
		$user = $_SESSION['user'];
		$loggedin = TRUE;
		$userstr = "($user)";
	}
	
	else $loggedin = FALSE;
	
	echo "<title>$appname$userstr</title><link rel='stylesheet' " . "href='meow4.css' type='text/css'>".
		"<link rel='preconnect' ". "href='https://fonts.gstatic.com'>".
		"<link href='https://fonts.googleapis.com/css2?family=Pacifico&display=swap' ". "rel='stylesheet'>".
		"<link href='https://fonts.googleapis.com/css2?family=Nerko+One&display=swap' ". "rel='stylesheet'>".
		"<link href='https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@300&display=swap' ". "rel='stylesheet'>".
		 "</head><body><center><canvas id='logo' width='624' " . "height='96'>$appname</canvas></center>" .
		 "<div class='appname'><div class='appname1'>$appname$userstr</div></div>" . "<script>
canvas                  = O('logo')
context                 = canvas.getContext('2d')
context.font            = 'bold italic 97px Georgia'
context.textBaseline    = 'top'
image         			= new Image()
image.src               = 'aasim.gif'

image.onload = function()
{
	gradient = context.createLinearGradient(0, 0, 0, 89)
	gradient.addColorStop(0.00, '#faa')
	gradient.addColorStop(0.66, '#f00')
	context.fillStyle = gradient
	context.fillText(  'R  bins Nest', 0, 0)
	context.strokeText('R  bins Nest', 0, 0)
	context.drawImage(image, 64, 32)
}

function O(obj)
{
	if(typeof obj == 'object') return obj
	else return document.getElementById(obj)
}

function S(obj)
{
	return O(obj).style
}

function C(name)
{
	var elements = document.getElementsBy TagName('*')
	var objects = []
	
	for(var i=0 ; i<elements.length ; ++i)
		if(elements[i].className == name)
			objects.push(elements[i])
			
	return objects
}
</script>";
		 
	if($loggedin)
		echo "<br ><nav id ='navbar'><ul class='menu'>" . 
		"<li><a href='members.php?view=$user'>Home</a></li>"   .
		"<li><a href='members.php'>Members</a></li>"           .
		"<li><a href='friends.php'>Friends</a></li>"           .
		"<li><a href='messages.php'>Messages</a></li>"         .
		"<li><a href='profile.php'>Edit Profile</a></li>"      .
		"<li><a href='logout.php'>Log out</a></li></ul></nav><br>" ;
	else
		echo ("<br><<nav id='navbar'><ul class='menu'>"   .
			  "<li><a href='index.php'>Home</a></li>"		   .
			  "<li><a href='signup.php'>Sign Up</a></li>"      .
			  "<li><a href='login.php'>Log In</a></li></ul></nav><br>"  .
			  "<span class='info'> You must be logged in to " .
			  "view this page.</span><br><br>");
			 
		
?>