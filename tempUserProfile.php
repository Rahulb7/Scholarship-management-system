<?php
  session_start();
  $_SESSION['selectedAppID'] = 0;
  $_SESSION['currentUserName'] = NULL;
  $_SESSION['appList'] = NULL;
  
  //check validity of the user
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
    
    $getName = "select S.firstName, S.middleName, S.lastName from student S where S.studentID = '".$_SESSION['currentUserID']."'";
    $nameResult = mysqli_query($conn,$getName);
    while($rows9=mysqli_fetch_row($nameResult)){
      foreach ($rows9 as $key => $value){
	 	    if($key == 0){
			    $_SESSION['currentUserName'] = $value;
	      }
		    if($key == 1){
			    $_SESSION['currentUserName'] = $_SESSION['currentUserName'] . " " . $value;
		    }
	      if($key == 2){                                	
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

  
      <!-- Bootstrap Core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="css/main.css" rel="stylesheet">

  </head>

  <body class = "no-sidebar">
    <div id = "page-wrapper">

      <!-- Header -->
        <header id = "header">
          <h1 id = "logo"><a href = "tempUserHome.php"><span>UP</span>SMS</a></h1>
          <nav id = "nav">
            <ul>
              <li><a href = "tempUserHome.php">Home</a></li>
              <li class = "current"><a href = "#">User Profile</a></li>
              <li><a href = "tempUserApply.php">Apply</a></li>
              <li><a href = "tempUserView.php">View Scholarship Status</a></li>
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
										
                  <header><h1><b>User Profile</b></h1></header>

                          
                          <form method="POST" action="backend/userdata.php" class="form-horizontal" role="form">
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="lastName">Last Name:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="lastName" placeholder="Smith">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="firstName">First Name:</label>
                              <div class="col-sm-10"> 
                                <input type="name" class="form-control" name="firstName" placeholder="John">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="middleName">Middle Name:</label>
                              <div class="col-sm-10"> 
                                <input type="name" class="form-control" name="middleName" placeholder="N">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="nationality">Nationality:</label>
                              <div class="col-sm-10"> 
                                <input type="name" class="form-control" name="nationality" placeholder="Filipino">
                              </div>
                            </div> 
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="gender">Gender:</label>
                              <div class="col-sm-10"> 
                                <input type="name" class="form-control" name="gender" placeholder="Male">
                              </div>
                            </div> 
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="birthDate">Birthdate:</label>
                              <div class="col-sm-10"> 
                                <input type="date" class="form-control" name="birthDate">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="birthPlace">Birthplace:</label>
                              <div class="col-sm-10"> 
                                <input type="name" class="form-control" name="birthPlace" placeholder="Enter birthplace">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="presStreetAddr">Present Street Address:</label>
                              <div class="col-sm-10"> 
                                <input type="name" class="form-control" name="presStreetAddr" placeholder="Enter present street address (e.g. 10 Panganiban St.)">
                              </div>
                            </div> 
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="presProvCity">Present City:</label>
                              <div class="col-sm-10"> 
                                <input type="name" class="form-control" name="presProvCity" placeholder="Enter present province/city (e.g. Quezon City)">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="presRegion">Present Region:</label>
                              <div class="col-sm-10"> 
                                <input type="name" class="form-control" name="presRegion" placeholder="Enter present region (e.g. National Capital Region)">
                              </div>
                            </div>      
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="permStreetAddr">Permanent Street Address:</label>
                              <div class="col-sm-10"> 
                                <input type="name" class="form-control" name="permStreetAddr" placeholder="Enter permanent street address">
                              </div>
                            </div>     
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="permProvCity">Permanent City:</label>
                              <div class="col-sm-10"> 
                                <input type="name" class="form-control" name="permProvCity" placeholder="Enter permanent province/city">
                              </div>
                            </div> 
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="permRegion">Permanent Region:</label>
                              <div class="col-sm-10"> 
                                <input type="name" class="form-control" name="permRegion" placeholder="Enter permanent region">
                              </div>
                            </div> 
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="contactNo">Contact Number:</label>
                              <div class="col-sm-10"> 
                                <input type="name" class="form-control" name="contactNo" placeholder="9301234567">
                              </div>
                            </div> 
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="dept">Department:</label>
                              <div class="col-sm-10"> 
                                <input type="name" class="form-control" name="dept" placeholder="Department of Computer Science">
                              </div>
                            </div> 
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="college">College:</label>
                              <div class="col-sm-10"> 
                                <input type="name" class="form-control" name="college" placeholder="College of Engineering">
                              </div>
                            </div>  
                                                                                                                                              
                            <div class="form-group"> 
                              <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Submit</button>
                              </div>
                            </div>
                          </form>
                            <br><p>Mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>

                            <button id=showDivButton style="margin-bottom:15px" type="button" class="btn btn-primary">Edit User Profile</button>

                            <div id="editDiv" style="display:none">
                              <form class="form-inline" role="form">
                                <div class="form-group">
                                    <div class=row-bro>
                                      <b>Full Name</b>
                                      <input type="name" class="form-control" id="lastname" placeholder="lastname" disabled>
                                      <input type="name" class="form-control" id="firstname" placeholder="firstname" disabled>
                                      <input type="name" class="form-control" id="middlename" placeholder="middlename" disabled>
                                      <b>Nationality</b> <input type="nationality" class="form-control" id="nationality" placeholder="Filipino" disabled>
                                    </div>

                                    <div class=row-bro>
                                      <b>Gender</b> <input type="gender" class="form-control" id="gender" placeholder="Male" disabled>
                                      <b>Date of Birth</b> <input type="birthdate" class="form-control" id="birthdate" placeholder="06/14/96" disabled>
                                      <b>Place of Birth</b> <input type="birthplace" style="width: 305px" class="form-control" id="birthplace" placeholder="Quezon City, Philippines" disabled>
                                    </div>

                                    <div class=row-bro>
                                      <b>Present Address</b> <input type="address" style="width: 830px" class="form-control" id="presentaddress" value="14A Maligaya st. Brgy. Pinyahan, Quezon City, Philippines, 1101">
                                    </div>

                                    <div class=row-bro>
                                      <b>Permanent Address</b> <input type="address" style="width: 810px" class="form-control" id="permanentaddress" placeholder="Number, Street, District, City, Country, Zip Code">
                                    </div>

                                    <div class=row-bro>
                                      <b>Contact Number</b> <input type="number" class="form-control" id="contactnumber" placeholder="Phone/Cellphone">
                                      <b>Email Address</b> <input type="email" class="form-control" id="emailaddress" placeholder="myname@domain.com">
                                      <b>Degree Course</b> <input type="degree" style="width: 225px" class="form-control" id="degree" placeholder="BS Computer Science" disabled>
                                    </div>

                                    <div class=row-bro>
                                      <b>Student Number</b> <input type="studentnumber" class="form-control" id="studentnumber" placeholder="201310940" disabled>
                                      <b>Department</b> <input type="department" style="width: 295px" class="form-control" id="department" placeholder="Department of Computer Science" disabled>
                                      <b>College</b> <input type="college" class="form-control" id="college" placeholder="College of Engineering" disabled>
                                    </div>

                                    <button type="submit" style="margin-bottom:10px" class="btn btn-default">Submit</button>
                                  </div>
                              </form>
                            </div>

									</section>
								</div>

						</section>

					<!-- Two -->
						<section class="wrapper style1 container special">
							<div class="row">
								<div class="4u 12u(narrower)">

									<section>
										<header>
											<h3>This is Something</h3>
										</header>
										<p>Sed tristique purus vitae volutpat ultrices. Aliquam eu elit eget arcu commodo suscipit dolor nec nibh. Proin a ullamcorper elit, et sagittis turpis. Integer ut fermentum.</p>
										<footer>
											<ul class="buttons">
												<li><a href="#" class="button small">Learn More</a></li>
											</ul>
										</footer>
									</section>

								</div>
								<div class="4u 12u(narrower)">

									<section>
										<header>
											<h3>Also Something</h3>
										</header>
										<p>Sed tristique purus vitae volutpat ultrices. Aliquam eu elit eget arcu commodo suscipit dolor nec nibh. Proin a ullamcorper elit, et sagittis turpis. Integer ut fermentum.</p>
										<footer>
											<ul class="buttons">
												<li><a href="#" class="button small">Learn More</a></li>
											</ul>
										</footer>
									</section>

								</div>
								<div class="4u 12u(narrower)">

									<section>
										<header>
											<h3>Probably Something</h3>
										</header>
										<p>Sed tristique purus vitae volutpat ultrices. Aliquam eu elit eget arcu commodo suscipit dolor nec nibh. Proin a ullamcorper elit, et sagittis turpis. Integer ut fermentum.</p>
										<footer>
											<ul class="buttons">
												<li><a href="#" class="button small">Learn More</a></li>
											</ul>
										</footer>
									</section>

								</div>
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


<!-- Display Div Script -->
    <script type="text/javascript">
      var button = document.getElementById('showDivButton'); // Assumes element with id='button'
      button.onclick = function() {
          var div = document.getElementById('editDiv');
          if (div.style.display !== 'none') {
              div.style.display = 'none';
          }
          else {
              div.style.display = 'block';
          }
      };
    </script>

	</body>
</html>


