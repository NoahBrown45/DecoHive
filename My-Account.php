<?php

	session_start();


	if(!$_SESSION['loggedIn']){
		header('Location: http://www.decohive.com/login.php/');
	}
	
	include_once('Obj_Classes/user.php');
	
	$user = new user();
	
	$user->userID = $_SESSION['userID'];
	$user->getUser($user->userID);
	
	include 'header.php';
	
?>

<div class="welcome-bar">
	Welcome Back <?php echo $user->userName; ?>
</div>

<?php 
	include 'footer.php';
?>