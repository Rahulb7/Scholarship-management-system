<?php
session_start();

$selAppID = $_SESSION["selectedAppID"];

$currentUserID=$_SESSION['currentUserID'];
  if($currentUserID==NULL){
    header("Location:index.php");
  }


  // Connect to database
    $conn = new mysqli("localhost","root","","sms");

  // Checks Connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
	}



	//inserting Record to the database
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$middleName = $_POST['middleName'];
	$position = $_POST['position'];

	$sql = "UPDATE signatory set firstName='$firstName', lastName='$lastName', middleName='$middleName', position='$position' where sigID = '$currentUserID'";

	if($conn->query($sql)){
	    echo "<script>
				alert('There are no fields to generate a report');
				window.location.href='admin/ahm/panel';
			</script>";
	}
	else{
	 die('Error: '.$conn->error);
	}
	$conn->close();

	header("Location: ../tempSigProfile.php");
?>
