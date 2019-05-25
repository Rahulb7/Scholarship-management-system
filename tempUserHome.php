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
    $conn = new mysqli("localhost:3309","root","","sms");

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

<!DOCTYPE html>

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
      
      <title>Home</title>
  </head>

  <body class = "index">
    <div id = "page-wrapper">

      <!-- Header -->
        <header id = "header" class = "alt">
          <h1 id = "logo"><a href = "#"><span>UP</span>SMS</a></h1>
          <nav id = "nav">
            <ul>
              <li class = "current"><a href = "tempUserHome.php">Home</a></li>
              <li><a href = "tempUserProfile.php">User Profile</a></li>
              <li><a href = "tempUserApply.php">Apply</a></li>
              <li><a href = "tempUserView.php">View Scholarship Status</a></li>
              <li><?php echo $_SESSION['currentUserName']. " (ID:" . $_SESSION['currentUserID'] . ")"?></li>
              <li><a href = "backend/logout.php" class = "button special">Logout</a></li>
            </ul>
          </nav>
        </header>

      <!-- Banner -->
        <section id = "banner">
          <div class = "inner">
            <header>
              <h2>UPSMS</h2>
            </header>
            <p>Scholarship Management System<p>
            <footer>
              <ul class = "buttons vertical">
                <li><a href = "#main" class = "button fit scrolly">About</a></li>
              </ul>
            </footer>
          </div>
        </section>

        <!-- About (To be shifted on about page) -->
        <article id = "main">
          <header class = "special container">
            <span class = "icon fa-bar-chart-o"></span>
            <h2>Graph based info</h2>
            <p><u>From Database</u></p>

          </header>

          <section class="wrapper style2 container special-alt">
            <div class="row 50%">
              <div class="8u 12u(narrower)">

                <header>
                  <h2>INDIA'S LARGEST SCHOLARSHIP PLATFORM</h2>
                </header>
                <p>Making Education Affordable<br><br><br>Some Text with hyper links</p>
                <footer>
                  <ul class="buttons">
                    <li><a href="tempUserApply.php" class="button">Find Out More</a></li>
                  </ul>
                </footer>

              </div>
            </div>
          </section>

          <section class="wrapper style3 container special">

            <header class="major">
              <h2><strong>Find the best-fit scholarship</strong></h2>
              <h4>Choosing the right scholarship is a daunting task. Pick relevant scholarships and stand a chance to win.</h4>
            </header>

            <div class="row">
              <div class="6u 12u(narrower)">

                <section>
                  <a href="#" class="image featured"><img src="images/scholarships/merit-based-scholarship.jpg" alt="" /></a>
                  <header>
                    <h3>Scholarships for merit students</h3>
                  </header>
                  <p>Aspirants whose score is high in the academic, artistic, atheletic and in other activities will be provided with scholarship wither by the private organization or by student intended institutes. Purely , this king is based on thee mmerit score of the aspirants</p>
                </section>

              </div>

              <div class="6u 12u(narrower)">

                <section>
                  <a href="#" class="image featured"><img src="images/scholarships/PHYSICALLY-CHALLENGED-SCHOLARSHIPS.jpg" alt="" /></a>
                  <header>
                    <h3>Need based scholarships</h3>
                  </header>
                  <p>Aspirant who has financial economic problem to continue studies are given need based scholarship. Basically this scholarship is for aspirants who are ecnomically backward. The aspirants need to apply for this scholarship by filling the <b title="Free Application For Federal Students Aid">FAFSA</b></p>
                </section>

              </div>
            </div>
                
            <div class="row">
              <div class="6u 12u(narrower)">

                <section>
                  <a href="#" class="image featured"><img src="images/scholarships/MINORITIES-SCHOLARSHIPS.jpg" alt="" /></a>
                  <header>
                    <h3>Student specific scholarship</h3>
                  </header>
                  <p>The specific scholarships are provided to specify category of the students with respected to race, sex, religion, family, medical history and many other factors. The most common category in this category is Minority scholarship.</p>
                </section>

              </div>
              
              <div class="6u 12u(narrower)">

                <section>
                  <a href="#" class="image featured"><img src="images/scholarships/STUDY-BASED-SCHOLARSHIPS.jpg" alt="" /></a>
                  <header>
                    <h3>Career specific Scholarship</h3>
                  </header>
                  <p>The career specific scholarships mainly focuses on aspirants who wants to go for a specific field of study. Career specific scholarship will be provided by the college/university.</p>
                </section>

              </div>
            </div>

            <footer class="major">
              <ul class="buttons">
                <li><a href="#" class="button">Suggested Scholarships</a></li>
              </ul>
            </footer>

          </section>
        </article>

        <section id="cta">

          <header>
            <h2>Ready to do <strong>something</strong>?</h2>
            <p>Proin a ullamcorper elit, et sagittis turpis integer ut fermentum.</p>
          </header>
          <footer>
            <ul class="buttons">
              <li><a href="#" class="button special">TEXT</a></li>
              <li><a href="#" class="button">TEXT</a></li>
            </ul>
          </footer>
        </section>

      <!-- Footer -->
        <footer id="footer">

          <section class="wrapper style1 container special">
              <div class="row">

                <div class="4u 12u(narrower)">
                  <section>
                    <header>
                      <h3>STATE WISE SCHOLARSHIPS</h3>
                    </header>
                    <footer style="padding-left: 50px; text-align: left;">
                      <ul>
                        <li><a href="#">Top Scholarships of Gujarat</a></li>
                        <li><a href="#">Top Scholarships of Maharashtra</a></li>
                        <li><a href="#">Top Scholarships of Uttar Pradesh</a></li>
                        <li><a href="#">Top Scholarships of Punjab</a></li>
                        <li><a href="#">Top Scholarships of Chennai</a></li>
                        <li><a href="#">Top Scholarships of Delhi</a></li>
                        <li><a href="#">Top Scholarships of Madhya Pradesh</a></li>
                        <li><a href="#">Top Scholarships of Andhra Pradesh</a></li>
                      </ul>
                    </footer>
                  </section>
                </div>

                <div class="4u 12u(narrower)">
                  <section>
                    <header>
                      <h3>CURRENT CLASS SCHOLARSHIPS</h3>
                    </header>
                    <footer style="padding-left: 50px; text-align: left;">
                      <ul>
                        <li><a href="#">Top Scholarships for Class 1 to 10</a></li>
                        <li><a href="#">Top Scholarships for Class 11, 12</a></li>
                        <li><a href="#">Top Scholarships for Class 12 passed</a></li>
                        <li><a href="#">Top Scholarships for Graduation</a></li>
                        <li><a href="#">Top Scholarships for Post-Graduation</a></li>
                        <li><a href="#">Top Scholarships for PhD</a></li>
                        <li><a href="#">Top Scholarships for Diploma</a></li>
                        <li><a href="#">Top Scholarships for Certifications</a></li>
                      </ul>
                    </footer>
                  </section>
                </div>

                <div class="4u 12u(narrower)">
                  <section>
                    <header>
                      <h3>TYPE BASED SCHOLARSHIPS</h3>
                    </header>
                    <footer style="padding-left: 50px; text-align: left;">
                      <ul>
                        <li><a href="#">Top Scholarships for Girls/Women</a></li>
                        <li><a href="#">Top Scholarships based on Merit</a></li>
                        <li><a href="#">Top Scholarships based on Means</a></li>
                        <li><a href="#">Top Scholarships for Minorities</a></li>
                        <li><a href="#">Top Scholarships based on Talent</a></li>
                        <li><a href="#">Top Government Scholarships</a></li>
                        <li><a href="#">Top Scholarships for MBBS Students</a></li>
                        <li><a href="#">Top Scholarships for Engineers</a></li>

                      </ul>
                    </footer>
                  </section>
                </div>

              </div>
            </section>


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