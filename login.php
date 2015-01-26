<?php

	session_start();
		
	//check if user is already logged in...
	if ($_SESSION['loggedIn'] != true) {
		
		// Check form if is submited
		if(isSet($_POST['loggedIn'])) {
				
			// Connecting to the MySQL database...
				
			// Connection Parameters
			$servername = "localhost";
			$username = "decohive_emma";
			$password = "forever3666";
			$dbname = "decohive_main";
			
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
				
			// Test our connection
				
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
				
			$sql = "SELECT idUser, UserName, SaltedPassword, UserType FROM User WHERE User.UserName = '" . $_POST['userName'] . "'";
			$result = $conn->query($sql);
				
			$passwordCheck = "";
			$userNameCheck = "";
			$idCheck = 0;
			$userTypeCheck = 0;
				
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$passwordCheck = $row['SaltedPassword'];
					$userNameCheck = $row['UserName'];
					$idCheck = $row['idUser'];
					$userTypeCheck = $row['UserType'];
				}
			}
				
			$conn->close();
			
			// Check if user is equal with username and  password from config.php
			
			if($idCheck == 0 || $_POST['pass'] != $passwordCheck) {
				echo "Sorry, User Not Found.</br></br>";
				
				/*echo '<form action="" method="post">
				Username: <input type="text" name="userName"></br>
				Password: <input type="password" name="pass"></br>
				</br>
				<input type="submit" name="loggedIn" value="Login">
				</form>';*/
			} else {
				// Open the session for store user logged
				// session_start();
				// Setting the session
				$_SESSION['loggedIn'] = true;
				$_SESSION['userName'] = $userNameCheck;
				$_SESSION['userType'] = $userTypeCheck;
				$_SESSION['userID'] = $idCheck;
					
				if ($userTypeCheck == 0) {
					//echo 'This user is an admin.<br/><br/>';
					header("Location: http://www.decohive.com/admin.php");
					
					/* Make sure that code below does not get executed when we redirect. */
					exit;
				}
					
				//echo $_SESSION['loggedIn'] . ', ' . $_SESSION['userName'] . ', ' . $_SESSION['userType'] . '<br/>';
				//echo 'Welcome to Decohive ' . $_POST['userName'] . '.  Please click here to logout';
				
				header("Location: http://www.decohive.com/index.php/");
				
				/* Make sure that code below does not get executed when we redirect. */
				exit;
			}
			session_write_close();
		} else {
			// Form
			/* echo '<form action="" method="post">
			Username: <input type="text" name="userName"></br>
			Password: <input type="password" name="pass"></br>
			</br>
			<input type="submit" name="loggedIn" value="Login">
			</form>'; */ 
		}
	
	} else {
		//header("Location: http://www.decohive.com/My-Account.php");	
	}
	
	include("header.php");
?>

<form action="" method="post">
	Username: <input type="text" name="userName"><br />
	Password: <input type="password" name="pass"><br />
	<br />
	<input type="submit" name="loggedIn" value="Login">
</form>

<a id='sessionTest' href='javascript:void(0);' >Test Session</a>

<script type="text/javascript">
	$( document ).ready(function() {

		$("#sessionTest").click(function() {
			
			alert('testing remote session...');
			
			$.get('sessiontest.php', function ( data ) {
			    alert(data)
			});
		});
	
	});
</script>


<?php include("footer.php"); ?>