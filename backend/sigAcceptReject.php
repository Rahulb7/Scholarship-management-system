<!DOCTYPE HTML>
<html>
  <head>
  </head>
  <body>

  	<?php
	session_start();
	$currentUserID=$_SESSION['currentUserID'];
  	if($currentUserID==NULL){
    	header("Location:../index.php");
  	}

	try{
		/*Open a connection to mySQL*/
		// Connect to database
    	$conn = new mysqli("localhost","root","","sms");

		  // Checks Connection
	    if ($conn->connect_error) {
	      die("Connection failed: " . $conn->connect_error);
	    }

		/*If the accept button was clicked*/
		if ($_POST['accrej'] == 'Accept'){
			$appstatus = NULL;
			$verifiedBySignatory = NULL;
			$appID=$_POST['appID'];
			$sql = "SELECT * FROM application WHERE applicationID = $appID";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {
					$appstatus = $row['appstatus'];
					$verifiedBySignatory = $row['verifiedBySignatory'];
				}
			} else{
				?>
		 			<script type="text/javascript">
		 				alert('Error');
		 				location.replace("../tempSigApplication.php");
		 			</script>
	 			<?php
			}
			if($appstatus !== 'inactive'){
					$sql = "UPDATE `application` SET `appstatus` = 'Processing', `verifiedBySignatory` = 'Approved' WHERE `application`.`applicationID` = $appID;";
					if ($conn->query($sql) === TRUE) {
				 ?>
					<script type="text/javascript">
						alert('Application is in Accepted and Processing Mode now!');
						location.replace("../signatory/tempSigApplication.php");
					</script>
				<?php

					} else {
				 ?>
					<script type="text/javascript">
						alert('Error updating record');
						location.replace("../signatory/tempSigApplication.php");
					</script>
				<?php
					}
			} else{
				?>
				 <script type="text/javascript">
					 alert('Cannot Approve.\nThe Application is in inactive Mode');
					 location.replace("../signatory/tempSigApplication.php");
				 </script>
			 <?php
			}
		}

		/*If the reject button was clicked*/
		else if($_POST['accrej'] == 'Reject') {
			$appstatus = NULL;
			$verifiedBySignatory = NULL;
			$appID=$_POST['appID'];
			$sql = "SELECT * FROM application WHERE applicationID = $appID";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {
					$appstatus = $row['appstatus'];
					$verifiedBySignatory = $row['verifiedBySignatory'];
				}
			} else{
				?>
		 			<script type="text/javascript">
		 				alert('Error');
		 				location.replace("../signatory/tempSigApplication.php");
		 			</script>
	 			<?php
			}
			if($appstatus !== 'inactive'){
					$sql = "UPDATE `application` SET `appstatus` = 'Rejected', `verifiedBySignatory` = 'Rejected' WHERE `application`.`applicationID` = $appID;";
					if ($conn->query($sql) === TRUE) {
				 ?>
					<script type="text/javascript">
						alert('Application is in Rejected Mode now!');
						location.replace("../signatory/tempSigApplication.php");
					</script>
				<?php

					} else {
				 ?>
					<script type="text/javascript">
						alert('Error updating record');
						location.replace("../signatory/tempSigApplication.php");
					</script>
				<?php
					}
			} else{
				?>
				 <script type="text/javascript">
					 alert('Cannot Reject.\nThe Application is in inactive Mode');
					 location.replace("../signatory/tempSigApplication.php");
				 </script>
			 <?php
			}
		}
	}catch(PDOException $e){
		echo $e->getMessage();
	}
?>
	</body>
</html>
