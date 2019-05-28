	<!DOCTYPE HTML>

<html>
  <head>
  </head>
  <body>

  	<?php
	session_start();
	$currentUserID=$_SESSION['currentUserID'];
  	if($currentUserID==NULL){
    	header("Location:index.php");
  	}	
	
	try{
		/*Open a connection to mySQL*/
		// Connect to database 
    	$conn = new mysqli("localhost:3309","root","","sms");
  
		  // Checks Connection 
	    if ($conn->connect_error) {
	      die("Connection failed: " . $conn->connect_error);
	    }

		/*If the accept button was clicked*/
		if ($_POST['accrej'] == 'Accept'){
			$appID=$_POST['appID'];
			$sql = "UPDATE `application` SET `status` = 'Processing', `verifiedBySignatory` = 'Approved' WHERE `application`.`applicationID` = $appID;";
			if ($conn->query($sql) === TRUE) {
		 ?>
			<script type="text/javascript">
				alert('Application is in Accepted and Processing Mode now!');
				location.replace("../tempSigApplication.php");
			</script>
		<?php

			} else {
		 ?>
			<script type="text/javascript">
				alert('Error updating record');
				location.replace("../tempSigApplication.php");
			</script>
		<?php			
			}
		}
		
		/*If the reject button was clicked*/
		else {
			$appID=$_POST['appID'];
			$sql = "UPDATE `application` SET `status` = 'Rejected', `verifiedBySignatory` = 'Rejected' WHERE `application`.`applicationID` = $appID;";
			if ($conn->query($sql) === TRUE) {
		 ?>
			<script type="text/javascript">
				alert('Application is in Rejected Mode now!');
				location.replace("../tempSigApplication.php");
			</script>
		<?php

			} else {
		 ?>
			<script type="text/javascript">
				alert('Error updating record');
				location.replace("../tempSigApplication.php");
			</script>
		<?php			
			}
		}
	}

	catch(PDOException $e){
		echo $e->getMessage();
	}
?>
	</body>
</html>
