<?php 
	
	session_start();
	
	if ($_SESSION['userType'] != 0) {
		
		header('Location: http://www.decohive.com/index.php/');
		
		exit;
	}

	include("header.php");
	include("Obj_Classes/post.php");
	include("Obj_Classes/StatusMessages.php");
	include("Obj_Classes/user.php");
	
	$posts = post::getAllPosts(true, false);
	$users = user::getAllUsers(true, false);
	
	$sm = new StatusMessage();
	
?>

<script type="text/javascript">

	$(document).ready( function () {

		$("#user-tab").click( function () {

			$(".active-tab").toggleClass("active-tab");
			$("#users").toggleClass("active-tab");
			
		});

		$("#post-tab").click( function () {

			$(".active-tab").toggleClass("active-tab");
			$("#posts").toggleClass("active-tab");
			
		});
		
	});

</script>

    <div class="mainContent">
      <h1>Welcome to your admin control panel <?php echo $_SESSION['userName']; ?></h1>
      <div class="status_message">
      	<?php
      		echo $sm->getStatusMessage($_GET['status_message']);
      	?>
      </div>
      <div class='tab-holder' id='admin-tabs'>
      		<div class='tab-row' id='admin-tab-row'>
      			<span class='tab' id='post-tab'>Posts</span>
      			<span class='tab' id='user-tab'>Users</span>
      		</div>
      		
      		<!-- This Tab Lists All Of Our Posts -->
      		<div class='post-tab content-tab active-tab' id='posts'>
      			Here is your current list of blog posts:
      			<br />
      			<br />
      			<table class='post-list'>
      				<tr>
      					<th>Post Title</th>
      					<th>Post Content</th>
      					<th>Post Status</th>
      					<th>Edit</th>
      				</tr>
      				<?php 
      					
      					$Row_Num = 0;
      					
      					while($row = $posts->fetch_assoc()) {
      						echo "<tr class='";
      						if ($Row_Num == 0) {
      							echo "Row_A'";
      							$Row_Num = 1;
      						} elseif ($Row_Num == 1) {
      							echo "Row_B'";
      							$Row_Num = 0;
      						}
      						echo ">";
      						
      						echo "<td>" . $row["PostTitle"] . "</td>";
      						echo "<td>" . substr($row["PostContent"], 0, 50) . "...</td>";
      						echo "<td>";
      						
      						if ($row["PostStatus"] == 0) {
      							echo "Draft</td>";
      						} elseif ($row["PostStatus"] == 1) {
      							echo "Published</td>";
      						}
      						
      						echo "<td><a href='/Edit-Post.php?postId=" . $row["idPost"] . "'>Edit</a></td>";
      						
      						echo "</tr>";
      					}
      					
      				?>
      			</table>
      			<br />
      			<br />
      			<a class='create-post' id='create-post' href='/Edit-Post.php?postId=-1'>Create New Blog Post</a>
      		</div>
      		
      		<!-- This Tab Lists All Of Our Users -->
      		<div class='user-tab content-tab passive-tab' id='users'>
      			Here is your current list of users:
      			<br />
      			<br />
      			<table class='post-list'>
      				<tr>
      					<th>User Name</th>
      					<th>User Type</th>
      					<th>User Status</th>
      					<th>Edit</th>
      				</tr>
      				<?php 
      					
      					$Row_Num = 0;
      					
      					while($row = $users->fetch_assoc()) {
      						echo "<tr class='";
      						if ($Row_Num == 0) {
      							echo "Row_A'";
      							$Row_Num = 1;
      						} elseif ($Row_Num == 1) {
      							echo "Row_B'";
      							$Row_Num = 0;
      						}
      						echo ">";
      						
      						echo "<td>" . $row["UserName"] . "</td>";
      						echo "<td>";
      						
      						if ($row["UserType"] == 0) {
      							echo "Admin</td>";
      						} elseif ($row["UserType"] == 1) {
      							echo "Standard User</td>";
      						}
      						
      						echo "<td><a href='/Edit-User.php?userId=" . $row["idUser"] . "'>Edit</a></td>";
      						
      						echo "</tr>";
      					}
      					
      				?>
      			</table>
      			<br />
      			<br />
      			<a class='create-user' id='create-post' href='/Edit-User.php?userId=-1'>Create New User</a>
      		</div>
      		
      		<!-- This Tab Lists All Of Our Products -->
      		<div class='products-tab content-tab passive-tab' id='products'>
      			Here is your current list of Products:
      			<br />
      			<br />
      			<table class='product-list'>
      				<tr>
      					<th>Product Title</th>
      					<th>Product Description</th>
      					<th>Link</th>
      					<th>Edit</th>
      				</tr>
      				<?php 
      					
      					$Row_Num = 0;
      					
      					while($row = $users->fetch_assoc()) {
      						echo "<tr class='";
      						if ($Row_Num == 0) {
      							echo "Row_A'";
      							$Row_Num = 1;
      						} elseif ($Row_Num == 1) {
      							echo "Row_B'";
      							$Row_Num = 0;
      						}
      						echo ">";
      						
      						echo "<td>" . $row["UserName"] . "</td>";
      						echo "<td>";
      						
      						if ($row["UserType"] == 0) {
      							echo "Admin</td>";
      						} elseif ($row["UserType"] == 1) {
      							echo "Standard User</td>";
      						}
      						
      						echo "<td><a href='/Edit-User.php?userId=" . $row["idUser"] . "'>Edit</a></td>";
      						
      						echo "</tr>";
      					}
      					
      				?>
      			</table>
      			<br />
      			<br />
      			<a class='create-product' id='create-productt' href='/Edit-User.php?userId=-1'>Create New Product</a>
      			<a class='bulk-import-product' id="bulk-import-product"></a>
      		</div>
      		
      </div>
    </div>

<?php include("footer.php"); ?>