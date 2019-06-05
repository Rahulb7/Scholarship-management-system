<?php

  session_start();

	 //check validity of the user
  $currentUserID=$_SESSION['currentUserID'];
  if($currentUserID==NULL){
    header("Location:index.php");
  }
?>
<!DOCTYPE HTML>

<html>
  	<head>

 	</head>
 	<body>
 		
 	<?php
	
	try{
		 // Connect to database 
    	$conn = new mysqli("localhost","root","","sms");
  
  		// Checks Connection 
    	if ($conn->connect_error) {
      		die("Connection failed: " . $conn->connect_error);
    	}

		/*If the add button was clicked*/
		if($_POST['deladd'] == 'Submit Scholarship >'){

			$flag=0;
			$name = $_POST['schname'];
			$schlocation = $_POST['schlocation'];
			$schlocationfrom = $_POST['schlocationfrom'];
			$degree = $_POST['degree'];
			$gender = $_POST['gender'];
			// $religion = $_POST['religion'];
			$scholarshipp=$_POST['scholarship'];
			$appdeadline = $_POST['appdeadline'];
			$granteesNum = $_POST['granteesNum'];
			$funding = $_POST['funding'];
			$description = $_POST['description'];
			$eligibility = $_POST['eligibility'];
			$benefits = $_POST['benefits'];
			$apply = $_POST['apply'];
			$links = $_POST['links'];
			$contact = $_POST['contact'];
			$adminapproval = $_POST['adminapproval'];
			
			foreach($_POST['religion'] as $religion){
        		$religion .= ", ";
    		}

			$sql = "INSERT INTO scholarship (sigID,schname, schlocation,schlocationfrom,degree, gender, religion, sch, appDeadline, granteesNum, funding, description, eligibility, benefits, apply, links, contact, adminapproval) VALUES ('$currentUserID','$name','$schlocation','$schlocationfrom','$degree','$gender','$religion','$scholarshipp','$appdeadline','$granteesNum','$funding','$description','$eligibility','$benefits','$apply','$links','$contact','$adminapproval')";

			if ($conn->query($sql) === TRUE) {
    			$flag=1;	
			} else {
				$flag=0;
    			echo "Error: " . $sql . "<br>" . $conn->error;
			}

			if($flag==1){
			$folder=$currentUserID."_".$name;
			mkdir("../scholarship/$folder/");
			
				if(is_uploaded_file($_FILES['validate']['tmp_name'])) {  	
	      		    
	      		    //move_uploaded_file
				    copy($_FILES["validate"]["tmp_name"],"../scholarship/$folder/" . $_FILES["validate"]["name"]);
				    $fileupload = '1';
				}
			
			if($fileupload=='1'){
				 ?>	
				    <script type="text/javascript">
              			alert("Scholarship is added and will be further processed by Admin to validate!");
              			location.replace("../tempSigScholarship.php")
            		</script>
			  	<?php
			}
		

				
		}
		}

		else{
			//Update Query [Same as insert] 
		}

		$conn->close();

		
	}

	catch(Exception $e){
		echo $e->getMessage();
	}
	
?>
	</body>
</html>