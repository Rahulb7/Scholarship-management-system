	<?php
  session_start();

  //check validity of the user
  $currentUserID=$_SESSION['currentUserID'];
  if($currentUserID==NULL){
    header("Location:../index.php");
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


      <!-- Bootstrap Core CSS -->
      <link href="../css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="../css/main.css" rel="stylesheet">

  </head>

  <body class = "no-sidebar">
    <div id = "page-wrapper">

		<!-- Header -->
        <header id = "header" >
					<h1 id = "logo"><a href = "javascript:history.back()" class="button special">Back</a></h1>
          <nav id = "nav">
            <ul>
               <li ><a href = "tempSigHome.php">Home</a></li>
							 <li><a href = "tempSigProfile.php">User Profile</a></li>
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
              <li><a href = "../backend/logout.php" class = "button special">Logout</a></li>
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
											<h3 style="padding-left: 36%;"><strong>Your Scholarships</strong></h3><br>
										</header>

				                                <?php
				                                  	$sql = "SELECT * FROM scholarship WHERE sigID='".$_SESSION['currentUserID']."'";
													$result = $conn->query($sql);
													if ($result->num_rows > 0) {
				                                ?>
				                            <table class = "table table-hover table-condensed">
				                              <thead>
				                                <tr>
				                                  <th class = "col-md-1"><strong>Scholarship</strong></th>
				                                  <th class = "col-md-2"><strong>Application Deadline</strong></th>
				                                  <th class = "col-md-1"><strong>Applications Limit</strong></th>
																					<th class = "col-md-1"><strong>Total Applicants</strong></th>
				                               	  <th class = "col-md-1"><strong>Admin Approval</strong></th>
																					<th class = "col-md-1"><strong>Scholarship Status</strong></th>
				                                  <th class = "col-md-1"></th>

				                                </tr>
				                              </thead>
				                              <tbody>
				                              		<?php
				                              			while($row = $result->fetch_assoc()) {
				                              		?>
				                                    <tr>

				                                      <td style="text-transform : uppercase;"><strong><?php echo $row['schname']; ?></strong></td>
				                                      <td style="padding :1%">
				                                        <?php
				                                          $now = time();
				                                          $date = $row['appDeadline'];

				                                          if (strtotime($date) > $now){
				                                            echo "Ongoing", "(", $date, ")";
				                                          }

				                                          else{
				                                              echo "Finished";
				                                          }
				                                        ?>
				                                      </td>
				                                      <td><?php echo $row['granteesNum'];?></td>
																							<td>20</td>
				                                      <td><?php echo $row['adminapproval'];?></td>
																							<td><strong><u>active</u></strong></td>

					                                  <td>
				                                      	<form method = "post" name = "editScholarshipForm" action = "tempEditScholarship.php">
					                                      	<input type = "hidden" name = "scholarshipID" value = "<?php echo $row['scholarshipID']; ?>">
					                                        <button type = "submit" name="view" class = "btn btn-info">View</button>
					                                  	</form>
					                                  	</td>
				                                    </tr>
				                                <?php }?>
				                              </tbody>
				                              <?php
				                                }
				                                else{
				                               ?>
				                                	<h3 align="text-center">You Have Not Submitted Any Scholarship</h3>
				                               <?php
				                            	}
				                              ?>
				                            </table>


				                           <form action = "tempAddScholarship.php" class = "text-center">
												<input type = "submit" value = "Add Scholarship">
											</form>


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
      <script src="../js/jquery.min.js"></script>
      <script src="../js/jquery.dropotron.min.js"></script>
      <script src="../js/jquery.scrolly.min.js"></script>
      <script src="../js/jquery.scrollgress.min.js"></script>
      <script src="../js/skel.min.js"></script>
      <script src="../js/util.js"></script>
      <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
      <script src="../js/main.js"></script>
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../js/jquery.easing.min.js"></script>
    <script src="../js/jquery.fittext.js"></script>
    <script src="../js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/creative.js"></script>
	</body>
</html>
