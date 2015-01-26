<?php 
	
	session_start();

	include("header.php"); 

?>
    <div class="mainContent">
      <h1>Header in here</h1>
      <p>Paragraph in here</p>
    </div>
    
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