<!DOCTYPE HTML>
<html>
  <head>
   </head>
   <body>
   	<?php
	session_start();
  $_SESSION['selectedAppID'] = 0;

  $_SESSION['appList'] = NULL;

  //check validity of the user
  $currentUserID=$_SESSION['currentUserID'];
  $schid=$_SESSION['schid'];
  $sigID = $_SESSION['sigID'];
  if($currentUserID==NULL){
    header("Location:../index.php");
  }
  if($schid==NULL || $sigID==NULL){
  	header("Location:../student/tempUserApply.php");
  }
	if($_POST['apply'] == "Apply >>"){

		//inserting into database
		$flag=0;
		$date1=date("Y-m-d H:i:s");

		// Connect to database
	    $conn = new mysqli("localhost","root","","sms");

     	  // Checks Connection
	    if ($conn->connect_error) {
	        die("Connection failed: " . $conn->connect_error);
	    }

	    $sql="INSERT INTO application(studentID,sigID,scholarshipID,appDate) VALUES ('$currentUserID','$sigID','$schid','$date1')";
	    if (mysqli_query($conn, $sql)) {
			$flag=1;
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			$flag=0;
		}

		//uploading docs
		if($flag==1){
			$fileupload=NULL;
			$total = count($_FILES['file']['name']);
			$folder=$currentUserID."_".$schid;
			mkdir("../applications/$folder/");
			for( $i=0 ; $i < $total ; $i++ ) {
				if(is_uploaded_file($_FILES['file']['tmp_name'][$i])){
	      		    //move_uploaded_file
				    copy($_FILES["file"]["tmp_name"][$i],"../applications/$folder/" . $_FILES["file"]["name"][$i]);
				    $fileupload .='1';
				}
			}
			if($fileupload=='111'){
				 ?>
				    <script type="text/javascript">
				   		alert("Your Application is Submitted Successfully!");
				   		location.replace("../student/tempUserHome.php")
				   	</script>
			  	<?php
			}
		}
		else{
		?>
			<script>
				alert("Error! File upload Failed.");
				location.replace("../student/applyprocess.php");
			</script>
		<?php
		}
	}
?>
</body>
</html>
