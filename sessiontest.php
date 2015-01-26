<?php

	session_start();

	//This file is nothing more than a test to see if the session is functioning correctly.

	echo $_SESSION['loggedIn'] . ', ' . $_SESSION['userName'];

?>