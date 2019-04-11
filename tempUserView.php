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
						<section>								
						  <h1><strong>Admin Approval Status</strong></h1>			                    
                          <table class="table table-bordered">
                            <thead>
                                <tr>
                                  <th style="width:85%">Scholarship</th>
                                  <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  $queryScholarship = "SELECT S.name, A.status FROM application A join scholarship S on A.scholarshipID = S.scholarshipID WHERE studentID = $_SESSION[currentUserID]";
                                  $qSchoResult = mysqli_query($conn, $queryScholarship);
                            

                                  while($rows=mysqli_fetch_row($qSchoResult))
                                  { 
                                    foreach($rows as $key => $value){
                                      if ($key == 0){
                                        ?> <tr><td> <?php echo $value;
                                      }
                                      if ($key == 1){
                                    if ($value == 1){
                                      ?> <td class="success"> <?php echo "Approved";
                                    }
                                    if ($value == 0){
                                      ?> <td class="warning"> <?php echo "Pending";
                                    }
                                        
                                      }
                                    }

                                  }
                                ?>		                                			                                
                            </tbody>
                          </table>

                          <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur.</p>									
								
						</section>
					</div>

					<div class="content">
						<section>
							<h1><strong>Signatory Approval Status</strong></h1>
                          	<table class="table table-bordered">
                            	<thead>
                                	<tr>
                                  		<th style="width:60%">Scholarship</th>
                                  		<th style="width:10%">Signatory Status</th>
                                  		<th style="width:10%">Application ID</th>
                                	</tr>
                            	</thead>
                            	<tbody>
                                	<?php
                                  	$queryScholarship = "SELECT S.name, A.status, A.applicationID FROM application A join scholarship S on A.scholarshipID = S.scholarshipID WHERE studentID = $_SESSION[currentUserID]";
                                  	$qSchoResult = mysqli_query($conn, $queryScholarship);
                            

                                  	while($rows=mysqli_fetch_row($qSchoResult))
                                  	{
                                  		
                                    	foreach($rows as $key => $value){

	                                      	if ($key == 0){
	                                        	?> <tr ><td> <?php echo $value;
	                                      	}
	                                      	if($key == 1){			                                    		
	                                        ?>
	                                        	<td><button class="btn btn-default"><a href="tempViewSigStatus.php">View</a></button>
	                                        <?php
	                                      	}
	                                      	if($key == 2){
	                                      	?>
	                                      		<td><?php echo $value;
	                                      		$_SESSION["appID"] = $value;
	                                      	}
                                    	}

                                  	}
                                	?>		                                			                                
                            	</tbody>
                          	</table>
						</sectioN>
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


	</body>
</html>