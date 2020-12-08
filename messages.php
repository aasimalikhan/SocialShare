<?php
	require_once 'header.php';
	
	if(!$loggedin) die();
	
	if(isset($_GET['view'])) $view = sanitizeString($_GET['view']);
	else	$view = $user;
	
	if(isset($_POST['text']))
	{
		$text = sanitizeString($_POST['text']);
		
		if($text!= "")
		{
			$pm = substr(sanitizeString($_POST['pm']),0,1);
			$time = time();
			queryMysql("INSERT INTO messages VALUES(NULL,'$user','$view','$pm','$time','$text')");
		}
	}
	
	if($view != "")
	{
		if($view == $user) $name1 = $name2 = "Your";
		else
		{
			$name1 = "<a href='members.php?view=$view'>$view</a>'s";
			$name2 ="$view's";
		}
		echo "<div class='puns'><div class='pleothra center'>$name1 Messages</div></div>";
		showProfile($view);
		
		echo <<<_END
			<form method='post' action='messages.php?view=$view'><br><br>
			<div class='prey'>Type here to leave a message:</div><br>
			<textarea name='text' cols='40' rows='3'></textarea><br><span class='preym'>
			Public</span><input type='radio' name='pm' value='0' checked='checked'>
			<span class="check"></span><span class='preym'>
			Private</span><input type='radio' name='pm' value='1'>
			<span class="check"></span>
			<input class='button' type='submit' value='Post Message'></form><br>
			
_END;
		
		if(isset($_GET['erase']))
		{
			$erase = sanitizeString($_GET['erase']);
			queryMysql("DELETE FROM messages WHERE id=$erase AND recip='$user'");
		}
		
		$query = "SELECT * FROM messages WHERE recip='$view' ORDER BY time DESC";
		$result = queryMysql($query);
		$num = $result->num_rows;
		echo "<div class='designmsg'>";
		for($j = 0 ; $j < $num ; ++$j)
		{
			echo "<div class='lines'>";
			$row = $result->fetch_array(MYSQLI_ASSOC);
			
			if($row['pm'] == 0 || $row['auth'] == $user || $row['recip'] == $user)
			{	
				echo "<span class='preym'>";
				echo date('M jS \'y g:ia', $row['time']);
				echo "</span>";
				echo " <span class='preymo'><span class='preya'>"."<a href='messages.php?view" .$row['auth'] . "'>" .
					$row['auth']. "</a></span></span> ";
					
				if($row['pm'] == 0)
					echo "<span class='preyo'>wrote:</span>" . "<span class='preym'>". "&quot".$row['message'] . "&quot; </span>";
				else if($row['pm'] == 1)
					echo "<span class='preyo'>whispered:</span> <span class='whisper'>" ."<span class='preym'>"."&quot;".
						$row['message'] . "&quot;</span> ";
				
				if($row['recip'] == $user)
					echo "<a class='button4' href='messages.php?view=$view" .
						"&erase=" . $row['id'] . "'>erase</a>";
						
				echo "<br>";
				
			}
			echo "</div>";
		}
		echo "</div>";
	}
	if(!$num) echo "<br><span class='info'>No messages yet</span><br><br>";

	echo "<br><a class='button' href='messages.php?view=$view'>Refresh messages</a>";
?>
		</div><br>
	</body>
</html>
				
		