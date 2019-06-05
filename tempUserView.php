<?php
/* Start a session so that other files can access these variables */
  session_start();
  $_SESSION['selectedAppID'] = 0;
  $_SESSION['currentUserName'] = NULL;
  $_SESSION['appList'] = NULL;
  $currentUserID=$_SESSION['currentUserID'];
  if($currentUserID==NULL){
    header("Location:index.php");
  }
  /* Connect to database */
    $conn = new mysqli("localhost","root","","sms");
  /* Checks Connection */
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

$getName = "select S.firstName, S.middleName, S.lastName from student S where S.studentID = '".$_SESSION['currentUserID']."'";

$nameResult = mysqli_query($conn,$getName);
// Get every row of the table formed from the query
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


      <!-- Bootstrap Core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="css/main.css" rel="stylesheet">

  </head>

  <body class = "no-sidebar">
  	<script type="text/javascript">
  		function viewcontent(){
  			var selectone=document.getElementById("class");
  			var schview=document.getElementById("scholarship");
  			if(selectone!="select"){
  				<?php $scholarshipviewID = 'selectone'; ?>
  				schview.style.display = 'block';
  			}
  			else{
  				schview.style.display = 'none';
  			}
  		}
  	</script>
    <div id = "page-wrapper">

      <!-- Header -->
        <header id = "header">
          <h1 id = "logo"><a href = "tempUserHome.php">Scholarships <span>that matter</h1>
          <nav id = "nav">
            <ul>
              <li><a href = "tempUserHome.php">Home</a></li>
              <li><a href = "tempUserProfile.php">User Profile</a></li>
              <li><a href = "tempUserApply.php">Apply</a></li>
              <li class = "current"><a href = "#">View Scholarship Status</a></li>
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
                            <div class="form-group">
                            <?php
                           		$sql="SELECT * FROM application AS A JOIN scholarship AS S on A.scholarshipID=S.scholarshipID where studentID=$currentUserID";
					            $result = $conn->query($sql);
					            if($result->num_rows > 0){
                             ?>
                              <label style="margin-left: 30%"><h2><b>Select Your Application</b></h2></label>
                              <div class="col-sm-10">
                                <select name="class" id="class" onchange="viewcontent()" style="margin-left: 30%;padding-top: 1%;padding-bottom: 1%">

                                    <option value="select" selected>Select</option>
                            	<?php
                            		while($row = $result->fetch_assoc()){
                            			$tempschid=$row['scholarshipID'];
                            			$tempschname=$row['schname'];
                            	?>
                                    	<option value="<?php echo $tempschid;?>"><?php echo $tempschname;?></option>
                                <?php
                                	}
                                }
                                ?>
                                  </select>
                              </div>
                            </div>
                            <br><br>
						<section id="scholarship" style="display: none;">
							<h1><strong>Your Scholarship</strong></h1>
                          	<table class="table table-bordered">
                            	<thead>
                                	<tr>
                                  		<th style="width:10%">Application ID</th>
                                  		<th style="width:40%">Scholarship</th>
                                  		<th style="width:10%">Signatory Approval</th>
                                  		<th style="width:10%">Status</th>
                                	</tr>
                            	</thead>
                            	<tbody>
                                	<?php
                                  	$queryScholarship = "SELECT A.applicationID, S.schname, A.verifiedBySignatory, A.status  FROM application A join scholarship S on A.scholarshipID = S.scholarshipID WHERE A.studentID = $_SESSION[currentUserID] AND A.scholarshipID=$tempschid";
                                  	$qSchoResult = mysqli_query($conn, $queryScholarship);

                                  	while($rows=mysqli_fetch_row($qSchoResult))
                                  	{

                                    	foreach($rows as $key => $value){

	                                      	if ($key == 0){
	                                        	?> <tr ><td> <?php echo $value;
	                                        	$_SESSION["appID"] = $value;
	                                      	}
	                                      	if ($key == 1){
	                                        	?> </td><td> <?php echo $value;
	                                      	}
	                                      	if ($key == 2){
	                                        	?> </td><td> <?php echo $value;
	                                      	}
	                                      	if($key == 3){
	                                      	?>
	                                      		</td><td><?php echo $value;
	                                      	}
                                    	}

                                  	}
                                	?>
                            	</tbody>
                          	</table>
						</section>
					</div>
				</section>

        <section class="wrapper style1 container special">
            <div class="row">

              <div class="4u 12u(narrower)">
                <section>
                  <header>
                    <h3>STATE WISE SCHOLARSHIPS</h3>
                  </header>
                  <footer style="padding-left: 50px; text-align: left;">
                    <ul>
                      <li><a href="#">Top Scholarships of Gujarat</a></li>
                      <li><a href="#">Top Scholarships of Maharashtra</a></li>
                      <li><a href="#">Top Scholarships of Uttar Pradesh</a></li>
                      <li><a href="#">Top Scholarships of Punjab</a></li>
                      <li><a href="#">Top Scholarships of Chennai</a></li>
                      <li><a href="#">Top Scholarships of Delhi</a></li>
                      <li><a href="#">Top Scholarships of Madhya Pradesh</a></li>
                      <li><a href="#">Top Scholarships of Andhra Pradesh</a></li>
                    </ul>
                  </footer>
                </section>
              </div>

              <div class="4u 12u(narrower)">
                <section>
                  <header>
                    <h3>CURRENT CLASS SCHOLARSHIPS</h3>
                  </header>
                  <footer style="padding-left: 50px; text-align: left;">
                    <ul>
                      <li><a href="#">Top Scholarships for Class 1 to 10</a></li>
                      <li><a href="#">Top Scholarships for Class 11, 12</a></li>
                      <li><a href="#">Top Scholarships for Class 12 passed</a></li>
                      <li><a href="#">Top Scholarships for Graduation</a></li>
                      <li><a href="#">Top Scholarships for Post-Graduation</a></li>
                      <li><a href="#">Top Scholarships for PhD</a></li>
                      <li><a href="#">Top Scholarships for Diploma</a></li>
                      <li><a href="#">Top Scholarships for Certifications</a></li>
                    </ul>
                  </footer>
                </section>
              </div>

              <div class="4u 12u(narrower)">
                <section>
                  <header>
                    <h3>TYPE BASED SCHOLARSHIPS</h3>
                  </header>
                  <footer style="padding-left: 50px; text-align: left;">
                    <ul>
                      <li><a href="#">Top Scholarships for Girls/Women</a></li>
                      <li><a href="#">Top Scholarships based on Merit</a></li>
                      <li><a href="#">Top Scholarships based on Means</a></li>
                      <li><a href="#">Top Scholarships for Minorities</a></li>
                      <li><a href="#">Top Scholarships based on Talent</a></li>
                      <li><a href="#">Top Government Scholarships</a></li>
                      <li><a href="#">Top Scholarships for MBBS Students</a></li>
                      <li><a href="#">Top Scholarships for Engineers</a></li>

                    </ul>
                  </footer>
                </section>
              </div>

            </div>
          </section>
      
			<!-- TWO
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
 -->
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


	</body>
</html>
