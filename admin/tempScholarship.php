<?php
/*Start a session*/
  session_start();

   $conn = new mysqli("localhost","root","","sms");

  // Checks Connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_GET['scholarship'])){
    	$scholarship = $_GET['scholarship'];
    }else{
    	$scholarship = "All";
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
              <li class = "submenu current">
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

									<?php if($scholarship == "All") {   /*For all scholarships*/?>
									<section>
										<header>
											<h3 style="padding-left: 33%;font-size:30px"><?php echo $scholarship; ?> Scholarships  </h3><br>
										</header>
              				<?php
				                  $sql = "SELECT scholarshipID, sigID, schname, appDeadline, description, adminapproval, schstatus FROM scholarship ORDER BY `appDeadline` ASC "; //need to be ordered according to uploaded date.
													$result = $conn->query($sql);
													if ($result->num_rows > 0) {
				                                ?>
				                            <table class = "table table-bordered">
				                              <thead>
				                                <tr>
				                                  <th class = "col-md-1" style="width: 5%"><strong>SchID</strong></th>
				                                  <th class = "col-md-1" style="width: 5%"><strong>SigID</strong></th>
				                                  <th class = "col-md-1" style="width: 20%"><strong>Name</strong></th>
				                                  <th class = "col-md-1" style="width: 3%"><strong>Application DeadLine</strong></th>
				                                  <th class = "col-md-1" style="width: 5%;text-align:center;font-size:26px" colspan="5"><strong>Action</strong> </th>
                                          <!-- <th class = "col-md-1"></th>
				                               		<th class = "col-md-1"></th>
				                               		<th class = "col-md-1"></th>
				                                  <th class = "col-md-1"></th> -->

				                                </tr>
				                              </thead>
				                              <tbody>
				                                	<?php
				                              			while($row = $result->fetch_assoc()) {
				                              		?>
				                                    <tr>
				                                    	<td><?php
				                                    		$schID=$row['scholarshipID'];
				                                    		echo $row['scholarshipID']; ?></td>
				                                    	<td><?php
				                                    		$sigID=$row['sigID'];
				                                    		echo $row['sigID']; ?></td>
				                                      	<td><a href="#" data-toggle="modal" data-target="#scholarshipDescription"><?php
				                                      		$schname=$row['schname'];
				                                      		echo $row['schname']; ?></a></td>
				                                      	<td><?php echo $row['appDeadline']; ?></td>
                                                <td>
                    															<form action="tempSchView.php" method="post">
                    					                        <input type="hidden" name="schname" value="<?php echo $schname; ?>">
                    					                        <input type="hidden" name="sigID" value="<?php echo $sigID; ?>">
                                                      <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                    					                        <button name="view" value="View">View</button>
                    					                    </form>
                    														</td>
				                                      	<td>
				                                      		<form action="../backend/adminAcceptReject.php" method="post">
					                                          <input type="hidden" name="schID" value="<?php echo $schID; ?>">
					                                          <button name="accrej" value="Accept" <?php if($row['adminapproval'] === "Approved"){
                                                      echo "disabled";
                                                      echo " style = 'color:#fff'";
                                                    } ?>>Approve</button>
					                                        </form>
                    														</td>
                    														<td>
                    															 <form action="../backend/adminAcceptReject.php" method="post">
                    						                      <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                    						                      <button name="accrej" value="Reject" <?php if($row['adminapproval'] === "Rejected"){
                                                        echo "disabled";
                                                        echo " style = 'color:#fff'";
                                                      } ?>>Reject</button>
                    						                   </form>
                    														</td>
                                                <td>
                    															 <form action="../backend/adminBlockUnblockSch.php" method="post" onsubmit="confirmblock(this,'This will Block the Scholarship and corresponding Applications.\n This wont Block the corresponding Signatory.\n Are your Sure?')">
                    						                      <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                    						                      <button name="blk_unblk" value="blockScholarship" <?php if($row['schstatus'] === "inactive"){
                                                        echo "disabled";
                                                        echo " style = 'color:#fff'";
                                                      } ?>>Block</button>
                    						                   </form>
                    														</td>
                                                <td>
                    															 <form action="../backend/adminBlockUnblockSch.php" method="post" onsubmit="confirmunblock(this,'This will Unblock the Scholarships and corresponding Applications.\n This wont Unblock the corresponding Signatory.\n Are your Sure?')">
                    						                      <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                    						                      <button name="blk_unblk" value="unblockScholarship" <?php if($row['schstatus'] === "active"){
                                                        echo "disabled";
                                                        echo " style = 'color:#fff'";
                                                      } ?>>Unblock</button>
                    						                   </form>
                    														</td>
				                                    </tr>
				                              </tbody>
				                              <?php } ?>
				                            </table>
				                            <?php } ?>
									</section>
                <?php } else if($scholarship == "Pending" || $scholarship == "Approved" || $scholarship == "Rejected"){   /*For specified scholarships*/?>
									<section>
										<header>
											<h3 style="padding-left: 30%;font-size:30px"><?php echo $scholarship; ?> Scholarships</h3><br>
										</header>
              				<?php
				                  $sql = "SELECT scholarshipID, sigID, schname, appDeadline, description, adminapproval, schstatus FROM scholarship WHERE adminapproval='$scholarship' ORDER BY `appDeadline` ASC"; //need to be ordered according to uploaded date.
													$result = $conn->query($sql);
													if ($result->num_rows > 0) {
				                                ?>
                                        <table class = "table table-bordered">
    				                              <thead>
    				                                <tr>
    				                                  <th class = "col-md-1" style="width: 5%"><strong>SchID</strong></th>
    				                                  <th class = "col-md-1" style="width: 5%"><strong>SigID</strong></th>
    				                                  <th class = "col-md-1" style="width: 20%"><strong>Name</strong></th>
    				                                  <th class = "col-md-1" style="width: 3%"><strong>Application DeadLine</strong></th>
    				                                  <th class = "col-md-1" style="width: 5%;text-align:center;font-size:26px" colspan="5"><strong>Action</strong> </th>
                                              <!-- <th class = "col-md-1"></th>
    				                               		<th class = "col-md-1"></th>
    				                               		<th class = "col-md-1"></th>
    				                                  <th class = "col-md-1"></th> -->

    				                                </tr>
    				                              </thead>
    				                              <tbody>
				                                	<?php
				                              			while($row = $result->fetch_assoc()) {
				                              		?>
				                                    <tr>
				                                    	<td><?php
				                                    		$schID=$row['scholarshipID'];
				                                    		echo $row['scholarshipID']; ?></td>
				                                    	<td><?php
				                                    		$sigID=$row['sigID'];
				                                    		echo $row['sigID']; ?></td>
				                                      	<td><a href="#" data-toggle="modal" data-target="#scholarshipDescription"><?php
				                                      		$schname=$row['schname'];
				                                      		echo $row['schname']; ?></a></td>
				                                      	<td><?php echo $row['appDeadline']; ?></td>
                                                <td>
                                                  <form action="tempSchView.php" method="post">
                                                     <input type="hidden" name="schname" value="<?php echo $schname; ?>">
                                                    <input type="hidden" name="sigID" value="<?php echo $sigID; ?>">
                                                    <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                                                    <button name="view" value="View">View</button>
                                                  </form>
                                                </td>
				                                      	<td>
				                                      		<form action="../backend/adminAcceptReject.php" method="post">
					                                          <input type="hidden" name="schID" value="<?php echo $schID; ?>">
					                                          <button name="accrej" value="Accept" <?php if($row['adminapproval'] === "Approved"){
                                                      echo "disabled";
                                                      echo " style = 'color:#fff'";
                                                    } ?>>Approve</button>
					                                        </form>
                    														</td>
                    														<td>
                    															 <form action="../backend/adminAcceptReject.php" method="post">
						                                          <input type="hidden" name="schID" value="<?php echo $schID; ?>">
						                                          <button name="accrej" value="Reject" <?php if($row['adminapproval'] === "Rejected"){
                                                        echo "disabled";
                                                        echo " style = 'color:#fff'";
                                                      } ?>>Reject</button>
						                                        </form>
                    														</td>
                                                <td>
                    															 <form action="../backend/adminBlockUnblockSch.php" method="post" onsubmit="confirmblock(this,'This will Block the Scholarship and corresponding Applications.\n This wont Block the corresponding Signatory.\n Are your Sure?')">
                    						                      <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                    						                      <button name="blk_unblk" value="blockScholarship" <?php if($row['schstatus'] === "inactive"){
                                                        echo "disabled";
                                                        echo " style = 'color:#fff'";
                                                      } ?>>Block</button>
                    						                   </form>
                    														</td>
                                                <td>
                    															 <form action="../backend/adminBlockUnblockSch.php" method="post" onsubmit="confirmunblock(this,'This will Unblock the Scholarships and corresponding Applications.\n This wont Unblock the corresponding Signatory.\n Are your Sure?')">
                    						                      <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                    						                      <button name="blk_unblk" value="unblockScholarship" <?php if($row['schstatus'] === "active"){
                                                        echo "disabled";
                                                        echo " style = 'color:#fff'";
                                                      } ?>>Unblock</button>
                    						                   </form>
                    														</td>
				                                    </tr>
				                              </tbody>
				                              <?php } ?>
				                            </table>
				                            <?php } ?>
									</section>
                <?php } else {
                  echo "Invalid Request";
                } ?>
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
      function confirmblock(form,str){
        if(confirm(str)){
          document.blockform.submit();
        } else{
          event.preventDefault();
        }
      }

      function confirmunblock(form,str){
        if(confirm(str)){
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
