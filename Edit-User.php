<?php

	session_start();
	
	if ($_SESSION['userType'] != 0) {
	
		header('Location: http://www.decohive.com/');
	
		exit;
	}
	
	include 'Obj_Classes/user.php';
	
	// Get the information for the post (if it is not a new post).
	
	$user = new user();
	
	$user->userID = $_GET['userId'];
	$cmd = $user->getUser($_GET['userId']);
	
	// Are we saving the post, or loading for the first time?
	if(isSet($_POST['UserSaved'])) {
		
		// Set our posts new variables
		$user->userName = $_POST['UserName'];
		$user->saltedPassword = $_POST['SaltedPassword'];
		$user->userType = $_POST['userType'];
		
		$result = $user->writeUser();
		
		header("Location: http://www.decohive.com/admin.php?status_message=21");
	}
	
	include 'header.php';
	
	// Build the form that represents our user
	
	echo '<form action="" method="post">';
	echo 'Username: </br>';
	echo '<input type="text" class="user-text-control" name="UserName" id="UserName" value="' . $user->userName . '" /></br></br>';
	echo 'User Password:</br>';
	echo '<input type="password" class="user-text-control" name="SaltedPassword" id="SaltedPassword" value="' . $user->saltedPassword . '" /><br /><br />';
	echo 'UserType:</br>';
	echo '<select class="user-dropdown" name="userType" id="user-type" >
  			<option value="0">Admin</option>
  			<option value="1">Basic User</option>
	</select><br /><br />';
	echo '<input type="submit" name="UserSaved" value="Save User">';
	
	include 'footer.php';

?>