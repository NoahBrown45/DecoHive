<?php

include_once 'Obj_Classes/DB_Engine.php';

class user {

	// Class Variables
	public $userID = -1;
	public $userName = '';
	public $saltedPassword = '';
	public $userType = -1;
	public $userStatus = 0;

	// Constructors



	// Database reads and writes.

	public function getUser($id) {
			
		$dbConn = new DB_Engine();

		$dbConn->InitializeConnection('localhost', 'decohive_emma', 'forever3666', 'decohive_main');

		$sqlCommand = "SELECT * FROM decohive_main.User WHERE decohive_main.User.idUser = " . $id . ";";
			
		$results = $dbConn->ExecuteCommand($sqlCommand);
		
		$dbConn->CloseConnection();
		
		$row = $results->fetch_assoc();
		$this->userID = $id;
		$this->userName = $row['UserName'];
		$this->saltedPassword = $row['SaltedPassword'];
		$this->userType = $row['UserType'];
		$this->userStatus = 0;
			
	}

	public static function getAllUsers($isAdmin, $includeDeleted) {
			
		$dbConn = new DB_Engine();
			
		$dbConn->InitializeConnection('localhost', 'decohive_emma', 'forever3666', 'decohive_main');
			
		if ($includeDeleted) {
			$sqlCommand = "SELECT * FROM decohive_main.User;";
		} else {
			$sqlCommand = "SELECT * FROM decohive_main.User;";
		}
			
		$results = $dbConn->ExecuteCommand($sqlCommand);
			
		$dbConn->CloseConnection();
			
		return $results;
	}

	public function writeUser() {
			
		$dbConn = new DB_Engine();

		if ($dbConn->InitializeConnection('localhost', 'decohive_emma', 'forever3666', 'decohive_main') == 0) {

			$sqlCommand = "";

			if ($this->userID != -1) {
				$sqlCommand = "UPDATE User SET UserName='" . $this->userName . "', SaltedPassword='" . $this->saltedPassword . "', UserType='" . $this->userType . "' WHERE User.idUser = " . $this->userID . ";";
			} else {
				$sqlCommand = "INSERT INTO decohive_main.User (UserName, SaltedPassword, UserType) VALUES ('" . $this->userName . "', '" . $this->saltedPassword . "', '" . $this->userType . "');";
			}
				
			$dbConn->ExecuteCommand($sqlCommand);
			
			$dbConn->CloseConnection();

			return 0;
		} else {
			return -3;
		}
			
	}

}

?>