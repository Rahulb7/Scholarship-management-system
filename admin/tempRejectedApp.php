
<!DOCTYPE HTML>
<!--
	Twenty by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
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
       <header id = "header">
         <h1 id = "logo"><a href = "javascript:history.back()" class="button special">Back</a></h1>
          <nav id = "nav">
            <ul>
              <li class = ""><a href = "tempAdmin.php">Home</a></li>
              <li class = "submenu current">
                <a href = "#">Applications</a>
                <ul>
                  <li><a href = "tempPendingApp.php">Pending Students</a></li>
                  <li><a href = "tempAcceptedApp.php">Accepted Students</a></li>
                  <li><a href = "tempRejectedApp.php">Rejected Students</a></li>
                </ul>
              </li>
              <li class = "submenu">
                <a href = "tempScholarship.php">Scholarships</a>
                <ul>
                  <li><a href = "tempScholarship.php?scholarship=Pending">Pending Scholarships</a></li>
                  <li><a href = "tempScholarship.php?scholarship=Approved">Accepted Scholarships</a></li>
                  <li><a href = "tempScholarship.php?scholarship=Rejected">Rejected Scholarships</a></li>
                </ul>
              </li>
              <li class = "submenu">
                <a href = "">Users</a>
                <ul>
                  <li><a href = "tempAdminShow.php">Admin</a></li>
                  <li><a href = "tempSignatoryShow.php">Signatory</a></li>
                  <li><a href = "tempStudentShow.php">Students</a></li>
                </ul>
              </li>
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
											<h3><strong>Applications of Rejected Students</strong></h3>
										</header>
                        <?php
                        /* Connect to database */
                        $conn = new mysqli("localhost","root","","sms");
                        /* Checks Connection */
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }

                        $to_query = "SELECT A.applicationID,A.studentID,A.scholarshipID,S.schname,A.appDate,A.appstatus,A.verifiedBySignatory from application AS A join scholarship AS S ON A.scholarshipID=S.scholarshipID WHERE A.verifiedBySignatory='Rejected'";
                        $sql_result = mysqli_query($conn,$to_query);
                        if(mysqli_num_rows($sql_result) > 0){
                          ?>
                          <table class="table table-bordered">
                            <thead>
                              <tr>

                                <th class = "col-md-1"><strong>Application Number[ID]</strong></th>
                                <th class = "col-md-1"><strong>Applicant ID</strong></th>
                                <th class = "col-md-1"><strong>Scholarship ID</strong></th>
                                <th class = "col-md-1" style="width: 25%"><strong>Scholarship Name</strong></th>
                                <th class = "col-md-1" ><strong>Application Date</strong></th>
                                <th class = "col-md-1 text-center"><strong>AppStatus</strong></th>
                                <th class = "col-md-1"><strong>Signatory Approval</strong></th>

                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            while($rows=mysqli_fetch_row($sql_result))
                            {
                              $appID = 0;
                              foreach ($rows as $key => $value)
                                  {
                                    if ($key == 0)
                                    {
                                      $appID = $value;
                                      ?><tr><td><?php echo $appID;?></td><?php
                                    }
                                        if($key == 1)
                                        {
                                          ?><td><?php echo $value;?></td><?php
                                        }
                                        if($key == 2)
                                        {
                                           ?><td><?php echo $value;?></td><?php
                                        }
                                        if($key == 3)
                                        {
                                        	?><td><?php echo $value;?></td><?php
                                        }
                                        if($key == 4)
                                        {
                          				?><td><?php echo $value;?></td><?php
                                        }
                                    if ($key == 5)
                                    {
                                      ?><td><?php echo $value;?></td><?php
                                    }
                                    if($key == 6){
                                      ?>
                                        <td><?php echo $value;?></td>
                                <?php
                                    }
                                  }
                            }
                          } else{
                              echo "No Rejected Applications";
                          }
                        mysqli_close($conn);
                        ?>
                        </tbody>
                    </table>
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
	</body>
</html>
