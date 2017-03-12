<?php

	$username = $_POST["username"];
    $password = $_POST["password"];
	
	if ($username == "Admin")
	{
		if ($password == "admin123")
		{
			header("location: index1.php");
		}
		else
		{
			echo "Invalid password<br>";
			echo '<a href="/Login.html">Click here to go back to login screen</a>';
		}
	}
	else
	{
			echo "Invalid username<br>";
			echo '<a href="/Login.html">Click here to go back to login screen</a>';
	}
	
?>