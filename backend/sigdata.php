<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    session_start();

    $selAppID = $_SESSION["selectedAppID"];

    $currentUserID=$_SESSION['currentUserID'];
      if($currentUserID==NULL){
        header("Location:../index.php");
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
      ?>
    	     <script type="text/javascript">
    				alert('Updated Record Successfully!');
    				location.replace('../signatory/tempSigProfile.php')
    			</script>
      <?php
    	}
    	else{
        ?>
      	     <script type="text/javascript">
      				alert('Error updating Record');
      				location.replace('../signatory/tempSigProfile.php')
      			</script>
        <?php

    	}
    	$conn->close();
    ?>

  </body>
</html>
