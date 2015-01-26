<?php

	class DB_Engine {
		
		// Class variables
		
		private $conn;
		private $sqlCmd = "";
		private $isOpen = false;
		public $currentErr = "";
	
		// Class Functions
		
		public function InitializeConnection ($server = "", $user = "", $pass = "", $db = "") {
			
			// Open Our SQL Connection
			
			$this->conn = new mysqli($server, $user, $pass, $db);
			
			// Test our connection
			
			if ($conn->connect_error) {
				$this->isOpen = false;
				$this->currentErr = "Connection failed: " . $conn->connect_error;
				return -1;
			} else {
				$this->isOpen = true;
				return 0;
			}
		}
		
		public function ExecuteCommand ($cmd = "") {
			if ($this->isOpen == true) {
				return $this->conn->query($cmd);
			} else {
				$this->currentErr = "Please open connection before executing a command.";
				return -2;
			}
		}
		
		public function CloseConnection () {
			$this->conn->close();
			return 0;
		}
	}

?>