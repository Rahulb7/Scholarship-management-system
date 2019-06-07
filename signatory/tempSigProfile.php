<?php
  session_start();
  $_SESSION['selectedAppID'] = 0;

  $_SESSION['appList'] = NULL;

  //check validity of the user
  $currentUserID=$_SESSION['currentUserID'];
  if($currentUserID==NULL){
    header("Location:../index.php");
  }

  // Connect to database
    $conn = new mysqli("localhost","root","","sms");
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

  $firstName = $lastName = $middleName = $position =  NULL;
  //Get User Details
  $sql = "SELECT * FROM signatory WHERE sigID = '".$currentUserID."'";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()) {
    $upMail = $row["upMail"];
    $firstName = $row["firstName"];
    $lastName = $row["lastName"];
    $middleName = $row["middleName"];
    $contact = $row['contact'];
    $org = $row['organization/university'];
    $position = $row["position"];
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
    <div id = "page-wrapper">

      <!-- Header -->
        <header id = "header" >
          <h1 id = "logo"><a href = "javascript:history.back()" class="button special">Back</a></h1>
          <nav id = "nav">
            <ul>
               <li ><a href = "tempSigHome.php">Home</a></li>
							 <li class="current"><a href = "#">User Profile</a></li>
               <li class = "submenu">
                <a href = "">Scholarships</a>
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

                  <header><h1><b style="margin: 10% 0% 0% 42%;">User Profile</b></h1></header>
                            <!-- Compare user details -->
                        <div id="display">
                          <form method="post" action="../backend/sigdata.php" class="form-horizontal" role="form">

                            <?php if($upMail==NULL || $upMail==""){} else{ ?>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="upMail">Email:</label>
                                <div class="col-sm-10">
                                  <input type="email" class="form-control" value="<?php echo $upMail;?>" disabled>
                                </div>
                              </div>
                            <?php } ?>

                            <?php if($lastName==NULL || $lastName==""){} else{ ?>
                              <div class="form-group">
                                <label class="control-label col-sm-2" for="lastName">Last Name:</label>
                                <div class="col-sm-10">
                                  <input type="name" class="form-control" value="<?php echo $lastName;?>" disabled>
                                </div>
                              </div>
                            <?php } ?>

                            <?php if($firstName ==NULL || $firstName ==""){} else{ ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="firstName">First Name:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" value="<?php echo $firstName?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($middleName ==NULL || $middleName==""){} else{ ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="middleName">Middle Name:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" value="<?php echo $middleName?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($position==NULL || $position==""){} else{ ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="position">Position:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" value="<?php echo $position ?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php// if($contactNo==NULL || $contactNo=="0"){} else{ ?>
                            <!-- <div class="form-group">
                              <label class="control-label col-sm-2" for="contactNo">Contact Number:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" value="<?php// echo $contactNo?>" disabled>
                              </div>
                            </div> -->
                            <?php// } ?>


                          </form>
                          <button id="showDivButton" style="margin:2% 0% 3% 42%;" type="button" class="btn btn-primary">Edit User Profile</button>
                      </div>

                      <div id="editDiv" style="display:none">
                          <form method="POST" action="../backend/sigdata.php" class="form-horizontal" role="form">
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="firstName">Email:</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" value="<?php echo $upMail ?>" disabled>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="lastName">Last Name:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="lastName" value="<?php echo $lastName;?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="firstName">First Name:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="firstName" value="<?php echo $firstName?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="middleName">Middle Name:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="middleName" value="<?php echo $middleName?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="position">Position:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="position" value="<?php echo $position?>">
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default" style="margin:2% 0% 3% 42%;">Submit</button>
                              </div>
                            </div>
                          </form>

                      </div>
                  </section>
                </div>

            </section>

          <!-- footer -->

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


<!-- Display Div Script -->
    <script type="text/javascript">
      var button = document.getElementById('showDivButton'); // Assumes element with id='button'
      button.onclick = function() {
          var div = document.getElementById('editDiv');
          var disp = document.getElementById('display');
          if (div.style.display !== 'none') {
              div.style.display = 'none';
          }
          else {
              div.style.display = 'block';
              disp.style.display = 'none';
          }
      };
    </script>

  </body>
</html>
