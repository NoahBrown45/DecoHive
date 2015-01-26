<?php

	session_start();
	
	session_unset();
	
	header("Location: http://www.decohive.com/index.php/");
	
	exit;

?>