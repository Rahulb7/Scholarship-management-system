<?php
  session_start();
  $_SESSION['selectedAppID'] = 0;

  $_SESSION['appList'] = NULL;

  //check validity of the user
  $currentUserID=$_SESSION['currentUserID'];
  if($currentUserID==NULL){
    header("Location:index.php");
  }

  // Connect to database 
    $conn = new mysqli("localhost","root","","sms");

  // Checks Connection 
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

  $getName = "select S.firstName, S.middleName, S.lastName from student S where S.studentID = '".$_SESSION['currentUserID']."'";

  $nameResult = mysqli_query($conn,$getName);

  // Get every row of the table formed from the query
    while($rows9=mysqli_fetch_row($nameResult)){
      foreach ($rows9 as $key => $value){
	 	    if($key == 0){
          $_SESSION['currentUserName'] = $value;
		    }
    		if($key == 1){
    			$_SESSION['currentUserName'] = $_SESSION['currentUserName'] . " " . $value;
    		}
        if($key == 2){                                	
          $_SESSION['currentUserName'] = $_SESSION['currentUserName'] . ". " . $value;
  		  }
	    }
    }
    $conn->close();
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
          <h1 id = "logo"><a href = "tempUserHome.php">Scholarships <span>that matter</span></a></h1>
          <nav id = "nav">
            <ul>  
              <li><a href = "tempUserHome.php">Home</a></li>
              <li><a href = "tempUserProfile.php">User Profile</a></li>
              <li class = "current"><a href = "#">Apply</a></li>
              <li><a href = "tempUserView.php">View Scholarship Status</a></li>
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
          <?php 
            $conn = new mysqli("localhost","root","","sms");
            $schid=$_GET['sch'];
            $_SESSION['schid']=$schid;
            $sql="SELECT * FROM scholarship where scholarshipID=$schid";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
          ?>
            <section class="wrapper style4 container">

              <!-- Content -->
                <div class="content">
                  <section style="text-align: justify;"> 
                    <h1><b>What is <?php echo $row["schname"]; ?> ?</b></h1>
                    <p><?php echo $row["description"]; ?></p>
                  </section>
                  <br><hr><br>
                  <section>  
                    <h1><b>Who can apply for the scholarship?</b></h1>
                    <p><?php echo $row["eligibility"]; ?></p>
                  </section>
                  <br><hr><br>
                  <section>  
                    <h1><b>What are the benifits?</b></h1>
                    <p><?php echo $row["benefits"]; ?></p>
                  </section>
                  <br><hr><br>
                  <section>  
                    <h1><b>How can you apply?</b></h1>
                    <p><?php echo $row["apply"]; ?></p>
                  </section>
                  <br><hr><br>
                  <section>  
                    <h1><b>What are the documents required?</b></h1>
                    <p><?php //echo $row["documents"]; ?></p>
                  </section>
                  <br><hr><br>
                  <section> 
                    <h1><b>What are the selection criteria?</b></h1>
                    <p><?php //echo $row["selection"]; ?></p>
                  </section>
                  <br><hr><br>
                  <section>  
                    <h1><b>Important Links</b></h1>
                    <p><?php echo $row["links"]; ?></p>
                  </section>
                  <br><hr><br>
                  <section>  
                    <h1><b>Contact Details</b></h1>
                    <p><?php echo $row["contact"]; } } $conn->close(); ?></p>
                  </section>
                  <br><hr><br>
                  <form action="apply.php" method="post">
                      <?php $_SESSION["id"]=$schid; ?>
                      <input type="submit" name="apply" value="Apply >>">
                  </form>
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