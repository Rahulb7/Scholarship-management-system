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
?>

<!DOCTYPE HTML>
<html>
  <head>


      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="">
      <meta name="author" content="">


      <!-- Bootstrap Core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="css/main.css" rel="stylesheet">
      <link href="css/tempAboutUS.css" rel="stylesheet">
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
              <li><a href = "tempUserApply.php">Apply</a></li>
              <li><a href = "tempUserView.php">View Scholarship Status</a></li>
              <li><?php echo $_SESSION['currentUserName']. " (ID:" . $_SESSION['currentUserID'] . ")"?></li>
              <li><a href = "backend/logout.php" class = "button special">Logout</a></li>
            </ul>
          </nav>
        </header>

    <!--image-->

      <section>
        <!-- <section id="cta" > -->
          <div class="row">
            <img src="images/bg8.jpg" alt="Nature" style="width:100%" >
            <div class="text-block">
              <div class="transbox">
                <p>INDIA'S LARGEST SCHOLARSHIP PLATFORM<p>
              </div>
            </div>
          </div>
        </section>

      <article id="main" >
        <section class="wrapper style3 container special">
              <div class="test2">
                <img src="images/call-us.png" style="float:right;margin-left:2%" >
                <p style="text-align:justify">A large segment of India’s potential workforce is unemployable. With 76.04% literacy rate and an increasing number of dropouts failing to enrol or complete any form of higher education, the situation is worrying. Financial constraints, lack of know-how about education funding schemes are some of the some of the key contributors to this effect.</p>
                <p style="text-align:left">Buddy4Study, since 2011, is endeavouring to bridge the gap between scholarship providers and scholarship seekers. As India’s largest scholarship listing portal, we help more than 1 million students by connecting the right scholarships with the right students. Backed by its robust scholarship search engine, it is the only platform in the country that allows both seekers and scholarship providers to access curated scholarship information across the globe.</p>
              </div>
        </section>
    </article>

              <section class="wrapper style3 container special">
                <div class="row">
                  <div class="6u 12u(narrower)">

                    <section>
                      <a href="#" class="image featured"><img src="images/about-learning.jpg" alt="" style="height:300px"/></a>
                      <header>
                        <h3><b>We  are</b></h3>
                      </header>
                      <p>India’s largest scholarship network with the vision to make quality education accessible for all. A brainchild of IIT, IIM, and BITS Pilani alumni, Buddy4Study aggregates global scholarship information.</p>
                    </section>

                  </div>

                  <div class="6u 12u(narrower)">

                    <section>
                      <a href="#" class="image featured"><img src="images/our-mission.jpg" alt="" style="height:300px" /></a>
                      <header>
                        <h3><b>We  do</b></h3>
                      </header>
                      <p>We provide easy access to scholarships with end-to-end application support to seekers and end-to-end management and monitoring of scholarship programs to providers. </p>
                    </section>

                  </div>
                </div>
</div>

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

      <!-- Scripts -->
      <!-- jQuery --
      <script src="js/jquery.js"></script>

      <!-- Bootstrap Core JavaScript -->
      <script src="js/bootstrap.min.js"></script>
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
