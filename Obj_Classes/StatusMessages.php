<?php

	class StatusMessage {
		
		//Post Status Messages
		private $StatusMessages = array(
				//Post Status Messages
				"11" => "Post Saved Sucessfully.",
				"12" => "An Error Occured While Saving The Post.",
				
				//User Status Messages
				"21" => "User Saved Successfully."
		);
		
		public function getStatusMessage($MessageID) {
			return $this->StatusMessages[$MessageID];
		}
		
	}

?>