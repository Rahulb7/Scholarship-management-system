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
	$nationality = $_POST['nationality'];
	$gender = $_POST['gender'];
	$birthDate = $_POST['birthDate'];
	$birthPlace = $_POST['birthPlace'];
	$presStreetAddr = $_POST['presStreetAddr'];
	$presProvCity = $_POST['presProvCity'];
	$presRegion = $_POST['presRegion'];
	$permStreetAddr = $_POST['permStreetAddr'];
	$permProvCity = $_POST['permProvCity'];
	$permRegion = $_POST['permRegion'];
	$contactNo = $_POST['contactNo'];
	$dept = $_POST['dept'];
	$college = $_POST['college'];

	$sql = "UPDATE student set firstName='$firstName', lastName='$lastName', middleName='$middleName', nationality='$nationality', gender='$gender', birthDate='$birthDate', birthPlace='$birthPlace', presStreetAddr='$presStreetAddr', presProvCity='$presProvCity', presRegion='$presRegion', permStreetAddr='$permStreetAddr', permProvCity='$permProvCity', permRegion='$permRegion', contactNo='$contactNo', dept='$dept', college='$college' where studentID = '$currentUserID'";

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

	header("Location: ../tempUserProfile.php");
?>
