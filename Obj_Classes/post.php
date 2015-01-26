<?php

	include 'Obj_Classes/DB_Engine.php';
	
	class post {
		
		// Class Variables
		public $postID = -1;
		public $postTitle = '';
		public $postContent = '';
		public $postdate = '';
		public $postTags = "";
		public $postStatus = 0;
		
		// Constructors
		
		
		
		// Database reads and writes.
		
		public function getPost($id) {
			
			$dbConn = new DB_Engine();
				
			$dbConn->InitializeConnection('localhost', 'decohive_emma', 'forever3666', 'decohive_main');
				
			$sqlCommand = "SELECT * FROM decohive_main.Post WHERE decohive_main.Post.idPost = " . $id . ";";
			
			$results = $dbConn->ExecuteCommand($sqlCommand);
			
			$dbConn->CloseConnection();
			
			$row = $results->fetch_assoc();
			$this->postTitle = $row['PostTitle'];
			$this->postContent = $row['PostContent'];
			$this->postdate = $row['PostDate'];
			$this->postStatus = $row['PostStatus'];
			$this->postTags = $row['PostTags'];
			
		}
		
		public static function getAllPosts($isAdmin, $includeDeleted) {
			
			$dbConn = new DB_Engine();
			
			$dbConn->InitializeConnection('localhost', 'decohive_emma', 'forever3666', 'decohive_main');
			
			if ($includeDeleted) {
				$sqlCommand = "SELECT * FROM decohive_main.Post;";
			} else {
				$sqlCommand = "SELECT * FROM decohive_main.Post WHERE decohive_main.Post.PostStatus <> -1;";
			}
			
			$results = $dbConn->ExecuteCommand($sqlCommand);
			
			$dbConn->CloseConnection();
			
			return $results;
		}
		
		public function writePost() {
			
			$dbConn = new DB_Engine();
				
			if ($dbConn->InitializeConnection('localhost', 'decohive_emma', 'forever3666', 'decohive_main') == 0) {
				
				$sqlCommand = "";
				
				if ($this->postID != -1) {
					$sqlCommand = "UPDATE Post SET PostTitle='" . $this->postTitle . "', PostContent='" . $this->postContent . "', PostDate='" . $this->postdate . "', PostTags='" . $this->postTags . "', User_idUser = 1, PostStatus = " . $this->postStatus . "  WHERE Post.idPost = " . $this->postID . ";";
				} else {
					$sqlCommand = "INSERT INTO decohive_main.Post (PostTitle, PostContent, PostDate, PostTags, User_idUser, PostStatus) VALUES ('" . $this->postTitle . "', '" . $this->postContent . "', '" . $this->postdate . "', '" . $this->postTags . "', 1, " . $this->postStatus . ");";
				}
					
				if ($dbConn->ExecuteCommand($sqlCommand) == -2) {
					return -9;
				} else {
					$dbConn->CloseConnection();
				}
				
				return 0;
			} else {
				return -3;
			}
			
		}
		
	}

?>