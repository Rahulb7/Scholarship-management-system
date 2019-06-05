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
      <link href="css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="css/main.css" rel="stylesheet">

  </head>

  <body class = "no-sidebar">
    <div id = "page-wrapper">

      <!-- Header -->
        <header id = "header">
          <h1 id = "logo"><a href = "#">Scholarships<span> that matter</span></a></h1>
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
                <a href = "tempUsersShow.php">Users</a>
                <ul>
                  <li><a href = "tempAdminShow.php">Admin</a></li>
                  <li><a href = "tempSignatoryShow.php">Signatory</a></li>
                  <li><a href = "tempStudentShow.php">Students</a></li>
                </ul>
              </li>
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
                      <h1 style="text-align:center; font-size:25px">Student Details</h1>
                      <?php
                      try{
                        $conn = new mysqli("localhost","root","","sms");
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }

                        if(isset($_POST['showUser']) AND $_POST['showUser'] == "showStudent"){

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
                                <?php
                                  $sql="SELECT * FROM application AS A JOIN scholarship AS S on A.scholarshipID=S.scholarshipID where studentID=$studentID";
            					            $result = $conn->query($sql);
            					                 if($result->num_rows > 0){
                                      ?>
                                        <select style="float:inherit" name="class" id="class" onchange="viewcontent()" style="margin-left: 30%;padding-top: 1%;padding-bottom: 1%">
                                          <option value="select" selected>Select</option>
                                          <?php
                                        		while($row = $result->fetch_assoc()){
                                        			$tempschid=$row['scholarshipID'];
                                        			$tempschname=$row['schname'];
                                    	?>
                                        	<option value="<?php echo $tempschid;?>"><?php echo $tempschname;?></option>
                                      <?php
                                      	}
                                      } else {
                                      ?>
                                        <h1>No Applications</h1>
                                      <?php
                                      }
                                      ?>
                                      </select>
                                </td>
                              </tr>
                        </table>
                        <?php
                            }
                          }
                        }
                      } catch(Exception $e){}
                       ?>
									</section>

                  <section id="scholarship" style="display: none;">
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
                            	$queryScholarship = "SELECT A.applicationID, S.schname, A.scholarshipID, A.verifiedBySignatory, A.appDate, A.appstatus  FROM application A join scholarship S on A.scholarshipID = S.scholarshipID WHERE A.studentID = $studentID AND A.scholarshipID=$tempschid";
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
                    <form name="blockform" method="post" onsubmit="confirmblock(this)" action="backend/adminBlockUser.php">
                      <input type="hidden" name="ID" value="<?php echo $studentID; ?>">
                      <input type="submit"  name="blockUser" id="blockUserbtn" value="blockStudent" <?php if($status === "inactive"){
                        echo "disabled";
                        echo " style = 'color:#fff'";
                      } ?>>
                    </form><br>

                    <form name="unblockform" action="backend/adminUnblockUser.php" onsubmit="confirmunblock(this)"  method="post">
                      <input type="hidden" name="ID" value="<?php echo $studentID; ?>">
                      <input type="submit" name="unblockUser" id="unblockUserbtn" value="unblockStudent" <?php if($status === "active"){
                        echo "disabled";
                        echo " style = 'color:#fff'";
                      } ?>>
                    </form>
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

      function confirmblock(form){
        if(confirm("This will Block Student as well as All his Applications.\n Are your Sure?")){
          document.blockform.submit();
        } else{
          event.preventDefault();
        }
      }

      function confirmunblock(form){
        if(confirm("This will unblock Student as well as All his Applications.\n Are your Sure?")){
          document.unblockform.submit();
        } else{
          event.preventDefault();
        }
      }
  	</script>
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
