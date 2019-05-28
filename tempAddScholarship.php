<?php

  session_start();

  

	 //check validity of the user
  $currentUserID=$_SESSION['currentUserID'];
  if($currentUserID==NULL){
    header("Location:index.php");
  }

  // Connect to database 
    $conn = new mysqli("localhost:3309","root","","sms");
  
  // Checks Connection 
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

$getName = "select S.firstName, S.middleName, S.lastName from signatory S where S.sigID = '".$_SESSION['currentUserID']."'";

$nameResult = mysqli_query($conn,$getName);

while($rows9=mysqli_fetch_row($nameResult))
{
foreach ($rows9 as $key => $value)
	{
	 	if($key == 0)
		{
			$_SESSION['currentUserName'] = $value;
		}

		
		if($key == 1)
		{
			$_SESSION['currentUserName'] = $_SESSION['currentUserName'] . " " . $value;
		}

		
	    if($key == 2)
	    {                                	
			$_SESSION['currentUserName'] = $_SESSION['currentUserName'] . ". " . $value;
		}
	}
}  
?>
<!DOCTYPE HTML>

<html>
  <head>
      <title>Home</title>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="">
      <meta name="author" content="">

      <link href="css/bootstrap.min.css" rel="stylesheet">

      <link href="css/main.css" rel="stylesheet">

  </head>

  <body class = "no-sidebar">

  	<script type="text/javascript">
          function fileValidation(name){
              var fileInput = document.getElementById(name);
              var filePath = fileInput.value;
              var allowedExtensions = /(\.pdf)$/i;
              if(!allowedExtensions.exec(filePath)){
                  alert('Please upload file having extensions .pdf only.');
                  fileInput.value = '';
                  return false;
              }else if(fileInput.files[0].size > 8000000){
                alert('File size too large');
                  fileInput.value = '';
                  return false;
              }
              else{ }
          } 
          </script>

    <div id = "page-wrapper">

      <!-- Header -->
        <header id = "header" >
          <h1 id = "logo"><a href = "#">Scholarships <span>that matter</span></a></h1>
          <nav id = "nav">
            <ul>
              <li ><a href = "tempSigHome.php">Home</a></li>
               <li class = "current submenu">
                <a href = "#">Scholarships</a>
                <ul>
                  <li><a href = "tempSigScholarship.php">My Scholarships</a></li>
                  <li><a href = "tempAddScholarship.php">Add Scholarships</a></li>
                </ul>
              </li>
              <li class = "submenu">
                <a href = "#">Applications</a>
                <ul>
                  <li><a href = "tempSigApplication.php?app=Pending">Pending applications</a></li>
                  <li><a href = "tempSigApplication.php?app=Approved">Accepted Applicaitons</a></li>
                  <li><a href = "tempSigApplication.php?app=Rejected">Rejected Applicaitons</a></li>
                </ul>
              </li>
              <li><?php echo $_SESSION['currentUserName']. " (ID:" . $_SESSION['currentUserID'] . ")"?></li>
              <li><a href = "backend/logout.php" class = "button special">Logout</a></li>
            </ul>
          </nav>
        </header>


			<!-- Main -->
				<article id="main">

					<header class="special container">
						<span class="icon fa-mobile"></span>
					</header>

					<!-- One -->
						<section class="wrapper style4 container">

							<!-- Content -->
								<div class="content">
									<section>
										
										<header>
											<h2 style="padding-left: 36%;"><strong><u>Add your Scholarship</u></strong></h2>
										</header>
                         
                         				<form method = "post" name = "scholarshiplist" id = "scholarshiplist" action = "backend/adminAddDelSch.php" enctype="multipart/form-data">
								
				                            <label><strong>Scholarship Name</strong></label><br>
				                            <label style="font-size: 15px;">This will be displayed and used for searching your scholarship</label>
				                            <br><input type = "text" name = "schname" placeholder="Eg:Joint Japan/World Bank Graduate Scholarship Program 2019" required>
				                            <br><br>

								            <label><strong>Locations</strong></label><br>
				                            <label style="font-size: 15px;">In which states or regions do the students need to study to be able to receive the scholarship?</label>
				                            <br><input type = "text" name = "schlocation" placeholder="Select one or multiple">
				                            <br><br>				                            
				                            
				                            <label><strong>Locations From</strong></label><br>
				                            <label style="font-size: 15px;">Is this scholarship specific for students from a specific state or region?</label>
				                            <br><input type = "text" name = "schlocationfrom" placeholder="Select one or multiple">
				                            <br><br>

				                            <label><strong>Degrees</strong></label><br>
				                            <label style="font-size: 15px;">This is a scholarship to study a ... (check all that apply)</label><br>
				                            <select name="degree" style="padding-top: 10px;padding-bottom: 10px; padding-left: 5%">
			                                    <option value="select" selected>Select</option>
			                                    <option value="class1">Class 1</option>
			                                    <option value="class2">Class 2</option>
			                                    <option value="class3">Class 3</option>
			                                    <option value="class4">Class 4</option>
			                                    <option value="class5">Class 5</option>
			                                    <option value="class6">Class 6</option>
			                                    <option value="class7">Class 7</option>
			                                    <option value="class8">Class 8</option>
			                                    <option value="class9">Class 9</option>
			                                    <option value="class10">Class 10</option>
			                                    <option value="class11">Class 11</option>
			                                    <option value="class12passed">Class 12 Passed</option>
			                                    <option value="diploma">Diploma</option>
			                                    <option value="graduation">Graduation</option>
			                                    <option value="postgraduation">Post-Graduation</option>
			                                    <option value="phd">PhD</option>
			                                </select>
				                            <br><br><br>

				                            <label><strong>Gender</strong></label><br>
				                            <label style="font-size: 15px;">This is a scholarship for a particular gender ...</label><br>
				                            <select name="gender" style="padding-top: 10px;padding-bottom: 10px; padding-left: 5%">
			                                    <option value="select" selected>Select</option>                                    
			                                    <option value="male">Male</option>
			                                    <option value="female">Female</option>
			                                    <option value="both">Both</option>
			                                    <option value="transgender">Transgender</option>
			                                </select>
			                                <br><br><br>

			                                <label><strong>Religion </strong></label><br>
				                            <label style="font-size: 15px;">This is a scholarship for a particular gender ...</label><br>
				                            <input type="checkbox" name="religion[]" value="buddhism">Buddhism<br>
				                            <input type="checkbox" name="religion[]" value="christian">Christian<br>
				                            <input type="checkbox" name="religion[]" value="hindu">Hindu<br>
				                            <input type="checkbox" name="religion[]" value="jain">Jain<br>
				                            <input type="checkbox" name="religion[]" value="Muslim">Muslim<br>
				                            <input type="checkbox" name="religion[]" value="Parsi">Parsi<br>
				                            <input type="checkbox" name="religion[]" value="Sikh">Sikh<br>
											<br><br>					                                

											<label><strong>Scholarship type</strong></label><br>
				                            <label style="font-size: 15px;">Selct any Type of Scholarship from Below ...</label><br>
				                            <select name="scholarship" style="padding-top: 10px;padding-bottom: 10px; padding-left: 10%">
			                                    <option value="select" selected>Select</option>
			                                    <option value="merit">Merit Based</option>
			                                    <option value="mean">Means Based</option>
			                                    <option value="cultural">Cultural Talent</option>
			                                    <option value="visual">Visual Art</option>
			                                    <option value="sport">Sports Talent</option>
			                                    <option value="science">Science, Maths Based</option>
			                                    <option value="tech">Technology Based</option>
			                                  </select>
			                                <br><br><br>

				                            <label><strong>Application Deadline</strong></label><br>
				                            <label style="font-size: 15px;">What is the deadline of application?</label>
				                            <br><input type = "date" name = "appdeadline">
				                            <br><br>

				                            <label><strong>Number of Applications maximum allowed</strong></label><br>
				                            <label style="font-size: 15px;">You can limit the number of applicants[This wont be displayed]</label>
				                            <br><input type = "text" name = "granteesNum">
				                            <br><br>

											<label><strong>Funding</strong></label><br>
				                            <label style="font-size: 15px;">Short description about funding. e.g. "$5000,-" or "100% tuition fee"</label>
				                            <br><input type = "text" name = "funding">
				                            <br><br>

											<label><strong>Description</strong></label><br>
				                            <label style="font-size: 15px;">Give a general description of the scholarship. This is the first text that users will read.</label>
				                            <br><textarea name = "description" rows="5"></textarea>
				                            <br><br>

											<label><strong>Eligibility</strong></label><br>
				                            <label style="font-size: 15px;">What students are eligible? Are there any requirements?</label>
				                            <br><textarea name = "eligibility" rows="5"></textarea>
				                            <br><br>

											<label><strong>Benefits</strong></label><br>
				                            <label style="font-size: 15px;">When a student gets the scholarship, what are their benefits?</label>
				                            <br><textarea name = "benefits" rows="5"></textarea>
				                            <br><br>

											<label><strong>How can you apply ?</strong></label><br>
				                            <label style="font-size: 15px;">How should a student apply? What are the requirements for application?</label>
				                            <br><textarea name = "apply" rows="5"></textarea>
				                            <br><br>

				                            <label><strong>Important Links</strong></label><br>
				                            <label style="font-size: 15px;">Provide links for your organization and scholarship if any.</label>
				                            <br><textarea name = "links" rows="5"></textarea>
				                            <br><br>

				                            <label><strong>Contact Details</strong></label><br>
				                            <label style="font-size: 15px;">Email, website, contact info ...</label>
				                            <br><textarea name = "contact" rows="5"></textarea>
				                            <br><br>

				                             <label><strong>Upload Document</strong></label>&nbsp;&nbsp;<label style="font-size: 15px;color: red; ">* This is compulsory.</label><br>
				                            <label style="font-size: 15px;">Provide a soft copy of your scholarship so as to validate your scholarship.</label>
				                            <br>
				                            <input type="file" name="validate" id="validate" onchange=" return fileValidation('validate')" required><br>
				                        	
				                            <br><br>
  
				                            <input type="hidden" name="adminapproval" value="Pending">

                            				<div class = "text-center">
                            					<input type = "submit" name = "deladd" value = "Submit Scholarship >">
											</div>
										</form>
								
										<br>
										<div class = "text-center">
											<form action = "tempSigScholarship.php">
												<input type = "submit" value = "Back">
											</form>
										</div>
									</div>

								</section>

							</div>

						</section>

				</article>

			<!-- Footer -->
				<footer id="footer">

					<ul class="icons">
						<li><a href="#" class="icon circle fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon circle fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon circle fa-google-plus"><span class="label">Google+</span></a></li>
						<li><a href="#" class="icon circle fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon circle fa-dribbble"><span class="label">Dribbble</span></a></li>
					</ul>

					<ul class="copyright">
						<li>&copy; Untitled</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>

				</footer>

		</div>

		<!-- Scripts -->
      <script src="js/jquery.min.js"></script>
      <script src="js/jquery.dropotron.min.js"></script>
      <script src="js/jquery.scrolly.min.js"></script>
      <script src="js/jquery.scrollgress.min.js"></script>
      <script src="js/skel.min.js"></script>
      <script src="js/util.js"></script>
      <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
      <script src="js/main.js"></script>
    <script type="text/javascript">
    function selectAll(){
      sel = document.getElementById("selSigList");
      for (var i = 0; i < sel.options.length; i++){
        sel.options[i].selected = true;
      }
    }

    </script> 


	</body>
</html>