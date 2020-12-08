<?php
	require_once 'header.php';
	
	if(!$loggedin) die();
	
	echo "<div class='main'>";
	
	if(isset($_GET['view']))//checking if the user clicked on the name of other user
	{
		$view = sanitizeString($_GET['view']);
		
		if($view == $user) $name = "Your";
		else               $name = "$view's";
		
		echo "<div class='pleothra center'>$name Profile</div>";
		showProfile($view);
		echo "<br><br><a class='button' href='messages.php?view=$view'>" .
			 "View $name messages</a><br><br>";
		die("</div></body></html>");
	}
	if(isset($_GET['add']))
	{
		$add = sanitizeString($_GET['add']);
		
		$result = queryMysql("SELECT * FROM friends WHERE user='$add'
			AND friend='$user'");//checking whether the other user is already a friend or not
		if(!$result->num_rows)
		{
			queryMysql("INSERT INTO friends VALUES('$add','$user')");
		}
	}
	else if(isset($_GET['remove']))
	{
		$remove = sanitizeString($_GET['remove']);
		queryMysql("DELETE FROM friends WHERE user='$remove' AND friend='$user'");
	}
	
	$result = queryMysql("SELECT user FROM members ORDER by user");
	$num = $result->num_rows;
	
	echo "<div class='pleothra center'>Other Members</div><ul>";
	
	for ($j = 0 ; $j < $num ; ++$j)
	{
		 $row = $result->fetch_array(MYSQLI_ASSOC);
		 if ($row['user'] == $user) continue;
		 echo "<li class='liststyleb'><a class='textbasic' href='members.php?view=" .
		 $row['user'] . "'>" . $row['user'] . "</a>";
		 $follow = "follow";
		 
		 $result1 = queryMysql("SELECT * FROM friends WHERE
		 user='" . $row['user'] . "' AND friend='$user'");
		 $t1 = $result1->num_rows;
		 
		 $result1 = queryMysql("SELECT * FROM friends WHERE
		 user='$user' AND friend='" . $row['user'] . "'");
		 $t2 = $result1->num_rows;
		 
		 if (($t1 + $t2) > 1) echo "<span class='textbasic'> &harr; is a mutual friend</span>";
		 elseif ($t1) echo "<span class='textbasic'> &larr; you are following</span>";
		 elseif ($t2) { echo "<span class='textbasic'> &rarr; is following you</span>";
		 $follow = "recip"; }
		 
		 if (!$t1) echo " <a class='butto4' href='members.php?add=" .
		 $row['user'] . "'>$follow</a>";
		 else echo " <a class ='button4' href='members.php?remove=" .
		 $row['user'] . "'>drop</a>";
	}
?>

		</ul></div>
	</body>
</html>
	
	
	
	
	
	
		
		