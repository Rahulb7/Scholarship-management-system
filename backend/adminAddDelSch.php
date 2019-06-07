<?php
  session_start();
	 //check validity of the user
  $currentUserID=$_SESSION['currentUserID'];
  if($currentUserID==NULL){
    header("Location:../index.php");
  }
?>
<!DOCTYPE HTML>
<html>
  	<head></head>
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

      //fetching input of array religion[]
      $religion = count($_POST['religion']) ? $_POST['religion'] : array();
      $religionn = implode(',',$religion);


			$sql = "INSERT INTO scholarship (sigID,schname, schlocation,schlocationfrom,degree, gender, religion, sch, appDeadline, granteesNum, funding, description, eligibility, benefits, apply, links, contact, adminapproval) VALUES ('$currentUserID','$name','$schlocation','$schlocationfrom','$degree','$gender','$religionn','$scholarshipp','$appdeadline','$granteesNum','$funding','$description','$eligibility','$benefits','$apply','$links','$contact','$adminapproval')";

			if ($conn->query($sql) === TRUE) {
        $query = "SELECT * FROM scholarship WHERE sigID = '".$currentUserID."' AND schname = '".$name."' AND description = '".$description."'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $schID = $row['scholarshipID'];
          }
        }
        $xml = new DOMDocument("1.0","UTF-8");
			  $xml->load("scholarship_data.xml");
  			$rootTag = $xml->getElementsByTagName("scholarships")->item(0);
  			$dataTag = $xml->createElement("scholarship");

  			$sigidtag = $xml->createElement("sigID",$currentUserID);
  			$schnametag = $xml->createElement("schname",$name);
        $schlocationtag = $xml->createElement("schlocation",$schlocation);
        $schlocationfromtag = $xml->createElement("schlocationfrom",$schlocationfrom);
        $degreetag = $xml->createElement("degree",$degree);
        $gendertag = $xml->createElement("gender",$gender);
        $religiontag = $xml->createElement("religion",$religionn);
        $schtag = $xml->createElement("sch",$scholarshipp);
        $appDeadlinetag = $xml->createElement("appDeadline",$appdeadline);
        $granteesNumtag = $xml->createElement("granteesNum",$granteesNum);
        $fundingtag = $xml->createElement("funding",$funding);
        $descriptiontag = $xml->createElement("description",$description);
        $eligibilitytag = $xml->createElement("eligibility",$eligibility);
        $benefitstag = $xml->createElement("benefits",$benefits);
        $applytag = $xml->createElement("apply",$apply);
        $linkstag = $xml->createElement("links",$links);
        $contacttag = $xml->createElement("contact",$contact);

  			$dataTag -> appendChild($sigidtag);
  			$dataTag -> appendChild($schnametag);
        $dataTag -> appendChild($schlocationtag);
        $dataTag -> appendChild($schlocationfromtag);
        $dataTag -> appendChild($degreetag);
        $dataTag -> appendChild($gendertag);
        $dataTag -> appendChild($religiontag);
        $dataTag -> appendChild($schtag);
        $dataTag -> appendChild($appDeadlinetag);
        $dataTag -> appendChild($granteesNumtag);
        $dataTag -> appendChild($fundingtag);
        $dataTag -> appendChild($descriptiontag);
        $dataTag -> appendChild($eligibilitytag);
        $dataTag -> appendChild($benefitstag);
        $dataTag -> appendChild($applytag);
        $dataTag -> appendChild($linkstag);
        $dataTag -> appendChild($contacttag);

  			$dataTag->setAttribute("scholarshipID",$schID);

  			$rootTag->appendChild($dataTag);
  			$xml->save("scholarship_data.xml");

    		$flag=1;
			} else {
				$flag=0;
    			echo "Error: " . $sql . "<br>" . $conn->error;
			}
			if($flag==1){
			$folder=$schID;
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
                			location.replace("../signatory/tempSigScholarship.php")
              		</script>
  			  	<?php
  			}
  		}
		}
		else if($_POST['deladd'] == 'EDIT Scholarship >'){
			//Update Query [Same as insert]

      $flag=0;
      $schID = $_POST['scholarshipID'];
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

      //fetching input of array religion[]
      $religion = count($_POST['religion']) ? $_POST['religion'] : array();
      $religionn = implode(',',$religion);


			$sql = "UPDATE scholarship SET schlocation = '$schlocation',schlocationfrom = '$schlocationfrom',
              degree = '$degree',gender = '$gender', religion = '$religionn', sch = '$scholarshipp', appDeadline = '$appdeadline',
              granteesNum = '$granteesNum', funding = '$funding', description = '$description', eligibility = '$eligibility',
              benefits = '$benefits', apply = '$apply', links = '$links', contact = '$contact', adminapproval = '$adminapproval'
              WHERE scholarshipID = '$schID' ";
			if ($conn->query($sql) === TRUE) {
        $xml=simplexml_load_file("scholarship_data.xml") or die("Error: Cannot create object");
        foreach($xml->children() as $scholarship){
            if($scholarship['scholarshipID'] == $schID){
              $scholarship->{'schlocation'} = $schlocation;
              $scholarship->{'schlocationfrom'} = $schlocationfrom;
              $scholarship->{'degree'} = $degree;
              $scholarship->{'gender'} = $gender;
              $scholarship->{'religion'} = $religionn;
              $scholarship->{'sch'} = $scholarshipp;
              $scholarship->{'appDeadline'} = $appdeadline;
              $scholarship->{'granteesNum'} = $granteesNum;
              $scholarship->{'funding'} = $funding;
              $scholarship->{'description'} = $description;
              $scholarship->{'eligibility'} = $eligibility;
              $scholarship->{'benefits'} = $benefits;
              $scholarship->{'apply'} = $apply;
              $scholarship->{'links'} = $links;
              $scholarship->{'contact'} = $contact;
            }
          }
          $xml->asXml('scholarship_data.xml');

    		$flag=1;
			} else {
				$flag=0;
    			echo "Error: " . $sql . "<br>" . $conn->error;
			}

			if($flag==1){
			$folder=$schID;
      echo $folder;
			$dir = "../scholarship/$folder/";
      if (is_dir($dir)){
        $files = glob($dir . '/*');
        foreach($files as $file){
            if(is_file($file)){
                unlink($file);
            }
        }

				if(is_uploaded_file($_FILES['validate']['tmp_name'])) {
	      		    //move_uploaded_file
				    copy($_FILES["validate"]["tmp_name"],"../scholarship/$folder/" . $_FILES["validate"]["name"]);
				    $fileupload = '1';
				} else{
          echo "CP";
        }
  			if($fileupload=='1'){
  				 ?>
  				    <script type="text/javascript">
                			alert("Scholarship is Updated and will be further processed by Admin to validate!");
                			location.replace("../signatory/tempSigScholarship.php")
              		</script>
  			  	<?php
  			}else{
          echo "CPFU";
        }
  		} else{
        echo "dir not found";
      }

		}
		$conn->close();
	}
}
	catch(Exception $e){
		echo $e->getMessage();
	}
?>
	</body>
</html>
