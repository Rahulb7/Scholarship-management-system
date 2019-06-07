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

      <link href="../css/bootstrap.min.css" rel="stylesheet">

      <link href="../css/main.css" rel="stylesheet">

  </head>

  <body class = "no-sidebar">
  	<script type="text/javascript">
  		function viewcontent(){
  			var selectone=document.getElementById("class").value;
  			var schview=document.getElementById("application");
  			if(selectone!="select"){
  				document.getElementById("schid").innerHTML = selectone;
  				schview.style.display = 'block';
  			}
  			else{
  				schview.style.display = 'none';
  			}
  		}
  	</script>
    <div id = "page-wrapper">

      <!-- Header -->
        <header id = "header" >
          <h1 id = "logo"><a href = "javascript:history.back()" class="button special">Back</a></h1>
          <nav id = "nav">
            <ul>
              <li ><a href = "tempSigHome.php">Home</a></li>
              <li><a href = "tempSigProfile.php">User Profile</a></li>
               <li class = "submenu">
                <a href = "#">Scholarships</a>
                <ul>
                  <li><a href = "tempSigScholarship.php">My Scholarships</a></li>
                  <li><a href = "tempAddScholarship.php">Add Scholarships</a></li>
                </ul>
              </li>
              <li class = "current submenu">
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
                            <div class="form-group">
                            <?php
                            try{
                              $app = NULL;
                            if(isset($_GET['app'])){
                              $app = $_GET['app'];
                              $flag = NULL;
                              if($app === 'Pending' || $app === 'Rejected' || $app === 'Approved'){
                                $flag=1;
                              }else if($app === 'All'){
                                $flag=2;
                              } else{
                                $flag=0;
                                ?>
                                <script type="text/javascript">
                                  alert('Invalid Request');
                                  location.replace('tempSigHome.php');
                                </script>
                                <?php
                              }
                            }
                            if(isset($_POST['app'])){
                              $app = $_POST['app'];
                            }
                           		$sql="SELECT scholarshipID,schname FROM scholarship where sigID=$currentUserID";
					                     $result = mysqli_query($conn,$sql);
                             ?>
                              <label style="margin-left: 30%"><h2><b>Select Your Scholarship</b></h2></label>
                              <div class="col-sm-10">
                              <center>
                               <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" name="login" >
                                <select name="class" id="class" onchange="viewcontent()" style="padding-top:2%;padding-bottom:2%;padding-left:2%;display:block;">
                                    <option value="select" selected><strong>Select Your Scholarship</strong></option>
                            	<?php
                            		while($rows9=mysqli_fetch_row($result)){
                            			foreach ($rows9 as $key => $value){
	                            			if($key == 0){
              												$tempschid = $value;
              											}
              											if($key == 1){
                            	?>
                                  		<option value="<?php echo $tempschid;?>"><?php echo $value;?></option>
                                <?php
                                			}
                                		}
                                	}
                                ?>
                              </select>
                                  <input type="hidden" id="app" name="app" value="<?php echo $app; ?>">
                                  <input type="submit" id="apply" name="apply" value="Select Scholarship >>" style="margin-top:2%;float:inherit">
                                  <input type="submit" id="showall" name="showall" value="<Show all>" style="margin-left:2%;margin-top:2%;float:inherit">
                                </form>
                              </center>
                              </div>
                            </div>
                            <br><br><br><br><br><br><br>
                      <?php
                        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'){
                          $app = $_POST['app'];
//DISPLAYING ALL APPS
                          if(isset($_POST['showall']) AND $_POST['showall'] == '<Show all>'){
                            ?>

                            <section id="application">
                                	<?php
                                  $queryScholarship = NULL;
                                    if($app === 'Pending' || $app === 'Approved' || $app === 'Rejected'){
                                      $queryScholarship = "SELECT applicationID,studentID,scholarshipID,appDate,appstatus,verifiedBySignatory FROM `application` WHERE `sigID`=$currentUserID AND `verifiedBySignatory` = '$app'";
                                    }else{
                                      $queryScholarship = "SELECT applicationID,studentID,scholarshipID,appDate,appstatus,verifiedBySignatory FROM `application` WHERE `sigID`=$currentUserID";
                                    }
                                  	$qSchoResult = mysqli_query($conn, $queryScholarship);
                                    if($qSchoResult->num_rows > 0){
                                      ?>
                                      <h1><strong><center>Displaying All <?php echo $app; ?> Applications</center> </strong></h1>
                                      <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width:3%">Application ID</th>
                                                <th style="width:3%">Student ID</th>
                                                <th style="width:3%">Scholarship ID</th>
                                                <th style="width:3%">App Date</th>
                                                <th style="width:3%">Status</th>
                                                <th class = "col-md-1" style="width: 5%;text-align:center;font-size:26px" colspan="5"><strong>Action</strong> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                      <?php

                                  	while($rows=mysqli_fetch_row($qSchoResult))
                                  	{
                                      $status = NULL;
                                    	foreach($rows as $key => $value){
	                                      	if ($key == 0){
	                                        	?> <tr ><td>
                                              <?php
                                                $appID=$value;
                                                echo $value;
	                                      	}
	                                      	if ($key == 1){
	                                        	?> </td><td>
                                              <?php
                                                $studentID=$value;
                                                echo $value;
	                                      	}
                                          if ($key == 2){
                                            ?> </td><td>
                                             <?php
                                              $schID=$value;
                                              echo $value;
                                          }
	                                      	if ($key == 3){
	                                        	?> </td><td>
                                             <?php echo $value;
	                                      	}
	                                      	if ($key == 4){
	                                        	?> </td><td>
                                             <?php echo $value;
                                             $status = $value;
	                                      	}
	                                      	if ($key == 5){
	                                        	?>
                                             <?php
                                             $verifiedBySignatory = $value;
	                                      	}
                                    	}
                                    	?>

                                    </td><td>

                                      <form action="sigAppView.php" method="post">
                                        <input type="hidden" name="appID" value="<?php echo $appID; ?>">
                                         <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                                        <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">
                                        <button name="view" value="View">View</button>
                                      </form>

                                      </td><td>

                                    		<form action="../backend/sigAcceptReject.php" method="post">
                                          <input type="hidden" name="appID" value="<?php echo $appID; ?>">
                                          <button name="accrej" value="Accept" <?php if ($verifiedBySignatory == 'Approved'){
                                            echo "disabled";
                                            echo " style = 'color:#fff'";
	                                      	} ?> >Approve</button>
                                        </form>

                                        </td><td>

                                        <form action="../backend/sigAcceptReject.php" method="post">
                                          <input type="hidden" name="appID" value="<?php echo $appID; ?>">
                                          <button name="accrej" value="Reject" <?php if ($verifiedBySignatory == 'Rejected'){
                                            echo "disabled";
                                            echo " style = 'color:#fff'";
	                                      	} ?>>Reject</button>
                                        </form>

                                        </td><td>

                                        <form name="blockform" action="../backend/sigBlockUnblockApp.php" method="post" onsubmit="confirmblock(this)">
                                          <input type="hidden" name="appID" value="<?php echo $appID; ?>">
                                          <button name="blk_unblk_app" value="blockapp" <?php if($status == 'inactive'){
                                            echo "disabled";
                                            echo " style = 'color:#fff'";
	                                      	} ?>>Block</button>
                                        </form>

                                      </td><td>

                                      <form name="unblockform" action="../backend/sigBlockUnblockApp.php" method="post" onsubmit="confirmunblock(this)">
                                        <input type="hidden" name="appID" value="<?php echo $appID; ?>">
                                        <button name="blk_unblk_app" value="unblockapp" <?php if($status != 'inactive'){
                                          echo "disabled";
                                          echo " style = 'color:#fff'";
                                        } ?>>UnBlock</button>
                                      </form>

                                    		</td>
                                      </tr>
                                    	<?php
                                  	}
                                  } else{
                                    echo "<center><b>No Scholarship Found for the selected option</b></center>";
                                  }
                                	?>
                            	</tbody>
                          	</table>
      						     </section> <?php
                          } else{
// Scholarship Based Apps
                      ?>
                            <section id="application">
                            	<?php
                              if($_POST['class']!='select'){
                                $id=$_POST['class'];
                                    $queryScholarship = NULL;
                                    if($app === 'Pending' || $app === 'Approved' || $app === 'Rejected'){
                                      $queryScholarship = "SELECT applicationID,studentID,scholarshipID,appDate,appstatus,verifiedBySignatory FROM `application` WHERE `scholarshipID`=$id AND `sigID`=$currentUserID AND `verifiedBySignatory` = '$app'";
                                    }else{
                                      $queryScholarship = "SELECT applicationID,studentID,scholarshipID,appDate,appstatus,verifiedBySignatory FROM `application` WHERE `scholarshipID`=$id AND `sigID`=$currentUserID";
                                    }
                                  	$qSchoResult = mysqli_query($conn, $queryScholarship);
                                    if($qSchoResult->num_rows > 0){
                                      ?>
                                      <h1><strong><center><?php echo $app; ?> Applications of Scholarship ID: <?php echo $id;?></center> </strong></h1>
                                     <table class="table table-bordered">
                                       <thead>
                                           <tr>
                                               <th style="width:3%">Application ID</th>
                                               <th style="width:3%">Student ID</th>
                                                <th style="width:3%">Scholarship ID</th>
                                               <th style="width:3%">App Date</th>
                                                <th style="width:3%">Status</th>
                                               <th class = "col-md-1" style="width: 5%;text-align:center;font-size:26px" colspan="5"><strong>Action</strong> </th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                      <?php
                                  	while($rows=mysqli_fetch_row($qSchoResult))
                                  	{
                                      $status = NULL;
                                    	foreach($rows as $key => $value){
	                                      	if ($key == 0){
	                                        	?> <tr ><td>
                                              <?php
                                                $appID=$value;
                                                echo $value;
	                                      	}
	                                      	if ($key == 1){
	                                        	?> </td><td>
                                              <?php
                                                $studentID=$value;
                                                echo $value;
	                                      	}
                                          if ($key == 2){
                                            ?> </td><td>
                                             <?php
                                              $schID=$value;
                                              echo $value;
                                          }
	                                      	if ($key == 3){
	                                        	?> </td><td>
                                             <?php echo $value;
	                                      	}
	                                      	if ($key == 4){
	                                        	?> </td><td>
                                             <?php echo $value;
                                             $status = $value;
	                                      	}
	                                      	if ($key == 5){
	                                        	?>
                                             <?php
                                             $verifiedBySignatory = $value;
	                                      	}
                                    	}
                                    	?>

                                    </td><td>

                                      <form action="sigAppView.php" method="post">
                                        <input type="hidden" name="appID" value="<?php echo $appID; ?>">
                                         <input type="hidden" name="schID" value="<?php echo $schID; ?>">
                                        <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">
                                        <button name="view" value="View">View</button>
                                      </form>

                                      </td><td>

                                    		<form action="../backend/sigAcceptReject.php" method="post">
                                          <input type="hidden" name="appID" value="<?php echo $appID; ?>">
                                          <button name="accrej" value="Accept" <?php if ($verifiedBySignatory == 'Approved'){
                                            echo "disabled";
                                            echo " style = 'color:#fff'";
	                                      	} ?> >Approve</button>
                                        </form>

                                        </td><td>

                                        <form action="../backend/sigAcceptReject.php" method="post">
                                          <input type="hidden" name="appID" value="<?php echo $appID; ?>">
                                          <button name="accrej" value="Reject" <?php if ($verifiedBySignatory == 'Rejected'){
                                            echo "disabled";
                                            echo " style = 'color:#fff'";
	                                      	} ?>>Reject</button>
                                        </form>

                                        </td><td>

                                        <form name="blockform" action="../backend/sigBlockUnblockApp.php" method="post" onsubmit="confirmblock(this)">
                                          <input type="hidden" name="appID" value="<?php echo $appID; ?>">
                                          <button name="blk_unblk_app" value="blockapp" <?php if($status == 'inactive'){
                                            echo "disabled";
                                            echo " style = 'color:#fff'";
	                                      	} ?>>Block</button>
                                        </form>

                                      </td><td>

                                      <form name="unblockform" action="../backend/sigBlockUnblockApp.php" method="post" onsubmit="confirmunblock(this)">
                                        <input type="hidden" name="appID" value="<?php echo $appID; ?>">
                                        <button name="blk_unblk_app" value="unblockapp" <?php if($status != 'inactive'){
                                          echo "disabled";
                                          echo " style = 'color:#fff'";
                                        } ?>>UnBlock</button>
                                      </form>

                                    		</td>
                                      </tr>
                                    	<?php
                                  	}
                                  } else{
                                    echo "<center><b>No Scholarship Found for the selected option</b></center>";
                                  }
                                	?>
                            	</tbody>
                          	</table>
                          <?php } else{ ?>
                            <script type="text/javascript">
                              alert('Please Select A Scholarship');
                              location.replace('tempSigApplication.php');
                            </script>
                          <?php } ?>
      						     </section>
                <?php
                   }
                }
             mysqli_close($conn);
          } catch(Exception $e){}
          ?>
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
        if(confirm("This will Block corresponding Application.\n Are your Sure?")){
          document.blockform.submit();
        } else{
          event.preventDefault();
        }
      }
      function confirmunblock(form){
        if(confirm("This will Unblock corresponding Application.\n Are your Sure?")){
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
