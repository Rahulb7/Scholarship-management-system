<?php
  $studentID = NULL;
  $status =NULL;
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
                      <?php
                      try{
                        $conn = new mysqli("localhost","root","","sms");
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }

/* Student */         if(isset($_POST['showUser']) AND $_POST['showUser'] == "showStudent"){
                          ?><h1 style="text-align:center; font-size:25px">Student Details</h1><?php

                          $studentID = $_POST['ID'];
                          $sql = "SELECT * FROM student WHERE studentID='$studentID'";
                          $result = $conn->query($sql);
                          if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                        ?>
                        <table class="table">
                              <tr>
                                  <th style="width:50%"><b>Student ID</b></th>
                                  <td><?php echo $row['studentID']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Email ID</b></th>
                                  <td><?php echo $row['upMail']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Name</b></th>
                                    <td><?php echo $row['firstName'].' '.$row['middleName'].' '.$row['lastName']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Nationality</b></th>
                                  <td><?php echo $row['nationality']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Gender</b></th>
                                  <td><?php echo $row['gender']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>BirthDate</b></th>
                                  <td><?php echo $row['birthDate']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>BirthPlace</b></th>
                                  <td><?php echo $row['birthPlace']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Present address </b></th>
                                  <td><?php echo $row['presStreetAddr'].'<br/>'.$row['presProvCity'].'<br/>'.$row['presRegion']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Permanent address </b></th>
                                  <td><?php echo $row['permStreetAddr'].'<br/>'.$row['permProvCity'].'<br/>'.$row['permRegion']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Contact </b></th>
                                  <td><?php echo $row['contactNo']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>College</b></th>
                                  <td><?php echo $row['college']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Departement</b></th>
                                  <td><?php echo $row['dept']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Status</b></th>
                                  <td><?php echo $row['status']; $status = $row['status'] ?></td>
                              </tr>
                              <tr>
                                <th><b>Applications : </b></th>
                                <td>
                                  <button id="showapp" value="showapp" onclick="viewapp()">Show</button>
                                  <button id="hideapp" value="hideapp" onclick="hideapp()" style="display: none;">Hide</button>
                                </td>
                              </tr>
                        </table>
                        <section id="application" style="display: none;">
                          	<table class="table table-bordered">
                            	<thead>
                                	<tr>
                                  		<th style="width:10%">Application ID</th>
                                  		<th style="width:30%">Scholarship</th>
                                      <th style="width:10%">Scholarship ID</th>
                                  		<th style="width:10%">Signatory Approval</th>
                                      <th style="width:10%">Application Date</th>
                                  		<th style="width:10%">App Status</th>
                                	</tr>
                            	</thead>
                            	<tbody>
                                	<?php
                                  	$queryScholarship = "SELECT A.applicationID, S.schname, A.scholarshipID, A.verifiedBySignatory, A.appDate, A.appstatus  FROM application A join scholarship S on A.scholarshipID = S.scholarshipID WHERE A.studentID = $studentID";
                                  	$qSchoResult = mysqli_query($conn, $queryScholarship);

                                  	while($rows=mysqli_fetch_row($qSchoResult))
                                  	{

                                    	foreach($rows as $key => $value){
                                          if ($key == 0){
                                            ?> <tr><td> <?php echo $value;
                                          }
                                          if ($key == 1 || $key == 2 ||$key == 3 ||$key == 4 ||$key == 5){
                                          	?> </td><td> <?php echo $value;
                                        	}
                                        	if($key == 6){
                                        	?></td><td><?php echo $value; ?></td></tr><?php
                                        	}
                                    	}
                                  	}
                                	?>
                            	</tbody>
                          	</table>

            						</section><br>
                        <section style="text-align:center">
                          <form name="blockform" method="post" onsubmit="confirmblock(this,'This will Block Student as well as All his Applications.\n Are your Sure?')" action="../backend/adminBlockUser.php">
                            <input type="hidden" name="ID" value="<?php echo $studentID; ?>">
                            <input type="submit"  name="blockUser" id="blockUserbtn" value="blockStudent" <?php if($status === "inactive"){
                              echo " style = 'color:#fff;display:none'";
                            } ?>>
                          </form><br>

                          <form name="unblockform" action="../backend/adminUnblockUser.php" onsubmit="confirmunblock(this,'This will unblock Student as well as All his Applications.\n Are your Sure?')"  method="post">
                            <input type="hidden" name="ID" value="<?php echo $studentID; ?>">
                            <input type="submit" name="unblockUser" id="unblockUserbtn" value="unblockStudent" <?php if($status === "active"){
                              echo " style = 'color:#fff;display:none;'";
                            } ?>>
                          </form>
                        </section>
                        <?php
                            }
                          }
/* Signatory */         } else if(isset($_POST['showUser']) AND $_POST['showUser'] == "showSig"){
                          ?><h1 style="text-align:center; font-size:25px">Signatory Details</h1><?php

                          $sigID = $_POST['ID'];
                          $sql = "SELECT * FROM signatory WHERE sigID='$sigID'";
                          $result = $conn->query($sql);
                          if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                        ?>
                        <table class="table">
                              <tr>
                                  <th style="width:50%"><b>Signatory ID</b></th>
                                  <td><?php echo $row['sigID']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Email ID</b></th>
                                  <td><?php echo $row['upMail']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Name</b></th>
                                    <td><?php echo $row['firstName'].' '.$row['middleName'].' '.$row['lastName']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Organization/University</b></th>
                                  <td><?php echo $row['organization/university']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Position</b></th>
                                  <td><?php echo $row['position']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Contact </b></th>
                                  <td><?php echo $row['contact']; ?></td>
                              </tr>
                              <tr>
                                  <th style="width:50%"><b>Status</b></th>
                                  <td><?php echo $row['status']; $status = $row['status'] ?></td>
                              </tr>
                              <tr>
                                <th><b>Scholarships : </b></th>
                                <td>
                                  <button id="showsch" value="showsch" onclick="viewsch()">Show</button>
                                  <button id="hidesch" value="hidesch" onclick="hidesch()" style="display: none;">Hide</button>
                                </td>
                              </tr>
                        </table>
                        <section id="scholarship" style="display: none;">
                                	<?php
                                  	$queryScholarship = "SELECT * FROM scholarship WHERE sigID = $sigID";
                                    $result = $conn->query($queryScholarship);
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
                                                           <form action="../backend/adminBlockUnblockSch.php" method="post">
                                                              <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                                                              <button name="blk_unblk" value="blockScholarship" <?php if($row['schstatus'] === "inactive"){
                                                                echo "disabled";
                                                                echo " style = 'color:#fff'";
                                                              } ?>>Block</button>
                                                           </form>
                                                        </td>
                                                        <td>
                                                           <form action="../backend/adminBlockUnblockSch.php" method="post">
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
          				                            <?php }
                                	?>
            						</section><br>
                        <section style="text-align:center">
                          <form name="blockform" method="post" onsubmit="confirmblock(this,'This will Block Signatory, the Scholarships corresponding to them as well as All Applications.\n Are your Sure?')" action="../backend/adminBlockUser.php">
                            <input type="hidden" name="ID" value="<?php echo $sigID; ?>">
                            <input type="submit"  name="blockUser" id="blockUserbtn" value="blockSig" <?php if($status === "inactive"){
                              echo " style = 'color:#fff;display:none'";
                            } ?>>
                          </form><br>

                          <form name="unblockform" action="../backend/adminUnblockUser.php" onsubmit="confirmunblock(this,'This will Unblock Signatory, the Scholarships corresponding to them as well as All Applications.\n Are your Sure?')"  method="post">
                            <input type="hidden" name="ID" value="<?php echo $sigID; ?>">
                            <input type="submit" name="unblockUser" id="unblockUserbtn" value="unblockSig" <?php if($status === "active"){
                              echo " style = 'color:#fff;display:none;'";
                            } ?>>
                          </form>
                        </section>
                        <?php
                            }
                          }
/* ADMIN  */          } else if(isset($_POST['showUser']) AND $_POST['showUser'] == "showAdmin"){
                          echo "Admin";
                        }
                      } catch(Exception $e){}
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
      //Student
      function viewapp(){
        var showapp=document.getElementById("showapp");
        var hideapp=document.getElementById("hideapp");
  			var schview=document.getElementById("application");
        schview.style.display = 'block';
        hideapp.style.display = 'inline';
        showapp.style.display = 'none';
  		}

      function hideapp(){
        var showapp=document.getElementById("showapp");
        var hideapp=document.getElementById("hideapp");
        var schview=document.getElementById("application");
        schview.style.display = 'none';
        hideapp.style.display = 'none';
        showapp.style.display = 'inline';
  		}

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



      //Signatory
      function viewsch(){
        var showapp=document.getElementById("showsch");
        var hideapp=document.getElementById("hidesch");
  			var schview=document.getElementById("scholarship");
        schview.style.display = 'block';
        hideapp.style.display = 'inline';
        showapp.style.display = 'none';
  		}

      function hidesch(){
        var showapp=document.getElementById("showsch");
        var hideapp=document.getElementById("hidesch");
        var schview=document.getElementById("scholarship");
        schview.style.display = 'none';
        hideapp.style.display = 'none';
        showapp.style.display = 'inline';
  		}

  	</script>
      <script src="../js/jquery.min.js"></script>
      <script src="../js/jquery.dropotron.min.js"></script>
      <script src="../js/jquery.scrollgress.min.js"></script>
      <script src="../js/jquery.scrolly.min.js"></script>
      <script src="../js/util.js"></script>
      <script src="../js/skel.min.js"></script>
      <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
      <script src="../js/main.js"></script>
	</body>
</html>
