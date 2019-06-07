<?php
/* Start a session so that other files can access these variables */
  session_start();
  $_SESSION['selectedAppID'] = 0;
  $_SESSION['currentUserName'] = NULL;
  $_SESSION['appList'] = NULL;
  $currentUserID=$_SESSION['currentUserID'];
  if($currentUserID==NULL){
    header("Location:../index.php");
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
              <li><a href = "tempUserHome.php">Home</a></li>
              <li><a href = "tempUserProfile.php">User Profile</a></li>
              <li><a href = "tempUserApply.php">Apply</a></li>
              <li class = "current"><a href = "#">View Scholarship Status</a></li>
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
                           		$sql="SELECT * FROM application AS A JOIN scholarship AS S on A.scholarshipID=S.scholarshipID where studentID=$currentUserID";
					            $result = $conn->query($sql);
					            if($result->num_rows > 0){
                             ?>
                              <label style="margin-left: 30%"><h2><b>Select Your Application</b></h2></label>
                              <div class="col-sm-10">
                                <center>
                                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" name="login" >
                                    <select style="float:inherit" name="class" id="class" style="padding-top:2%;padding-bottom:2%;padding-left:2%;display:block;">
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
                                  <h1 style="margin-left:25%">You Have Not Applied To Any Scholarship</h1>
                                  <form name="gotoapply" action="tempUserApply.php" style="margin-left:33%">
                                    <input type="submit" value="Search For Scholarship" />
                                  </form>
                                <?php
                                }
                                ?>
                                </select>
                                <input type="submit" id="apply" name="apply" value="Select Scholarship >>" style="margin-top:2%;float:inherit">
                                <input type="submit" id="showall" name="showall" value="<Show all>" style="margin-left:2%;margin-top:2%;float:inherit">
                              </form>
                            </center>
                              </div>
                            </div>
                            <br><br><br><br><br>
                            <?php
                            if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'){
    //DISPLAYING ALL APPS
                              if(isset($_POST['showall']) AND $_POST['showall'] == '<Show all>'){
                                ?>

                                <section id="application">
                                  <center><h1><strong>Your Scholarship</strong></h1></center>
                                  	<table class="table table-bordered">
                                    	<thead>
                                        	<tr>
                                          		<th style="width:10%">Application ID</th>
                                          		<th style="width:40%">Scholarship</th>
                                          		<th style="width:10%">Signatory Approval</th>
                                          		<th style="width:10%">App Status</th>
                                        	</tr>
                                    	</thead>
                                    	<tbody>
                                        <?php
                                        	$queryScholarship = "SELECT A.applicationID, S.schname, A.verifiedBySignatory, A.appstatus  FROM application A join scholarship S on A.scholarshipID = S.scholarshipID WHERE A.studentID = $currentUserID";
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
                                              </td><td><?php echo $value;?></td></tr><?php
                                          	  }
                                          	}
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
                                ?>
                                <h1><strong>Your Scholarship</strong></h1>
                                	<table class="table table-bordered">
                                  	<thead>
                                      	<tr>
                                        		<th style="width:10%">Application ID</th>
                                        		<th style="width:40%">Scholarship</th>
                                        		<th style="width:10%">Signatory Approval</th>
                                        		<th style="width:10%">App Status</th>
                                      	</tr>
                                  	</thead>
                                  	<tbody>
                                      	<?php
                                        	$queryScholarship = "SELECT A.applicationID, S.schname, A.verifiedBySignatory, A.appstatus  FROM application A join scholarship S on A.scholarshipID = S.scholarshipID WHERE A.studentID = $currentUserID AND A.scholarshipID=$id";
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
                                              </td><td><?php echo $value;?></td></tr><?php
                                          	  }
                                          	}
                                        	}
                                      	?>
                                  	</tbody>
                                	</table>

                          <?php } else{ ?>
                            <script type="text/javascript">
                              alert('Please Select A Scholarship');
                              history.back();
                            </script>
                          <?php } ?>
      						     </section>
                       <?php
                        }
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
