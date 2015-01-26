<?php

	session_start();
	
	if ($_SESSION['userType'] != 0) {
	
		header('Location: http://www.decohive.com/index.php/');
	
		exit;
	}
	
	include 'Obj_Classes/post.php';
	
	// Get the information for the post (if it is not a new post).
	
	$post = new post();
	
	$post->postID = $_GET['postId'];
	$cmd = $post->getPost($_GET['postId']);
	
	// Are we saving the post, or loading for the first time?
	if(isSet($_POST['postSaved'])) {
		
		// Set our posts new variables
		$post->postTitle = $_POST['postTitle'];
		$post->postContent = $_POST['postContent'];
		$post->postStatus = $_POST['postStatus'];
		$post->postdate = date('Y/m/d');
		
		$result = $post->writePost();
		
		header("Location: http://www.decohive.com/admin.php?status_message=11");
	}
	
	include 'header.php';
	
	// Build the form that represents our post
	
	echo '<form action="" method="post">';
	echo 'Blog Title: </br>';
	echo '<input type="text" class="post-text-control" name="postTitle" id="post-title" value="' . $post->postTitle . '" /></br></br>';
	echo 'Blog Content:</br>';
	echo '<textarea name="postContent" id="post-content" rows="10" cols="80">' . $post->postContent . '</textarea><br /><br />';
	echo 'Blog Status:</br>';
	echo '<select class="post-dropdown" name="postStatus" id="post-status" selected="' . $post->postStatus . '" >
  			<option value="0">Draft</option>
  			<option value="1">Published</option>
  			<option value="-1">Deleted</option>
	</select><br /><br />';
	echo '<input type="submit" name="postSaved" value="Save Post">';
	echo '<script>CKEDITOR.replace("postContent");</script>';
	
	include 'footer.php';

?>

