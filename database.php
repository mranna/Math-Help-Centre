<?php
	$mysqli = new mysqli('localhost','hanil','hanil','C354_hanil');

	if($mysqli->connect_error){
		printf("Connection failed: %s\n", $mysqli->connect_error);
		exit();
	}
?>