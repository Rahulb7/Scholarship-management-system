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
        <header id = "header">
          <h1 id = "logo"><a href = "javascript:history.back()" class="button special">Back</a></h1>
          <nav id = "nav">
            <ul>
              <li class = ""><a href = "tempAdmin.php">Home</a></li>
              <li class = "submenu">
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
              </li><li class = "submenu current">
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
                      <h1 style="text-align:center; font-size:25px">Student Details</h1>
                      <?php
                        $conn = new mysqli("localhost","root","","sms");
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT * FROM student";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                          ?>
                          <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:10%">Student ID</th>
                                    <th style="width:30%">Email ID</th>
                                    <th style="width:20%">Name</th>
                                    <th style="width:10%">Status</th>
                                    <th style="width:7%"></th>
                                    <th style="width:7%"></th>
                                    <th style="width:7%"></th>
                                </tr>
                            </thead>
                            <tbody>
                          <?php
                            while($row = $result->fetch_assoc()) {
                                $studentID =$row['studentID'];
                                $email = $row['upMail'];
                                $name = $row['firstName']." ".$row['lastName'];
                                if($name == NULL || $name == ""){
                                  $name = "NULL";
                                }
                                $status = $row['status'];
                            ?>
                                <tr>
                                  <td><?php echo $studentID; ?></td>
                                  <td><?php echo $email; ?></td>
                                  <td><?php echo $name; ?></td>
                                  <td><?php echo $status; ?></td>
                                  <td>
                                    <form action="adminShowUser.php" method="post">
                                      <input type="hidden" name="ID" value="<?php echo $studentID; ?>">
                                      <button name="showUser" value="showStudent">View</button>
                                    </form>
                                  </td>
                                  <td>
                                    <form name="blockform" method="post" onsubmit="confirmblock(this)" action="../backend/adminBlockUser.php">
                                      <input type="hidden" name="ID" value="<?php echo $studentID; ?>">
                                      <button  name="blockUser" id="blockUserbtn" value="blockStudent" <?php if($row['status'] === "inactive"){
                                        echo "disabled";
                                        echo " style = 'color:#fff'";
                                      } ?>>Block</button>
                                    </form>
                                  </td>
                                  <td>
                                    <form name="unblockform" action="../backend/adminUnblockUser.php" onsubmit="confirmunblock(this)"  method="post">
                                      <input type="hidden" name="ID" value="<?php echo $studentID; ?>">
                                      <button name="unblockUser" id="unblockUserbtn" value="unblockStudent" <?php if($row['status'] === "active"){
                                        echo "disabled";
                                        echo " style = 'color:#fff'";
                                      } ?>>UnBlock</button>
                                    </form>
                                  </td>
                                </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                        <?php
                          } else {
                              echo "No result";
                          }
                          $conn->close();
                      ?>
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
      <script type="text/javascript">
        function confirmblock(form){
          if(confirm("This will Block Student as well as All their Applications.\n Are your Sure?")){
            document.blockform.submit();
          } else{
            event.preventDefault();
          }
        }
        function confirmunblock(form){
          if(confirm("This will unblock Student as well as All their Applications.\n Are your Sure?")){
            document.unblockform.submit();
          } else{
            event.preventDefault();
          }
        }
      </script>

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
