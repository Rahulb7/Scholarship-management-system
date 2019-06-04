 <?php
  session_start();
  $_SESSION['selectedAppID'] = 0;
  $_SESSION['currentUserName'] = NULL;
  $_SESSION['appList'] = NULL;
  $currentUserID=$_SESSION['currentUserID'];
  if($currentUserID==NULL){
    header("Location:index.php");
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
          <section class="wrapper style4 container">
                          <h1 style="padding-left: 40%"><strong>Apply for Scholarship</strong></h1>
                          <h1>Select Filters</h1>
                          <table>
                            <thead>
                               <tr>
                                 <th>Class</th>
                                 <th style="padding-left: 4%">Gender</th>
                                 <th style="padding-left: 4%">Religion</th>
                                 <th style="padding-left: 4%">Scholarship</th>
                                </tr>
                            </thead>
                            <tbody>
                          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" name="login" >
                                <tr>
                                  <td >
                                  <select name="class" style="display: inline;">
                                    <option value="select" selected>Select</option>
                                    <option value="class1">Class 1</option>
                                    <option value="class2">Class 2</option>
                                    <option value="class3">Class 3</option>
                                    <option value="class4">Class 4</option>
                                    <option value="class5">Class 5</option>
                                    <option value="class6">Class 6</option>
                                    <option value="class7">Class 7</option>
                                    <option value="class8">Class 8</option>
                                    <option value="class9">Class 9</option>
                                    <option value="class10">Class 10</option>
                                    <option value="class11">Class 11</option>
                                    <option value="class12passed">Class 12 Passed</option>
                                    <option value="diploma">Diploma</option>
                                    <option value="graduation">Graduation</option>
                                    <option value="postgraduation">Post-Graduation</option>
                                    <option value="phd">PhD</option>
                                  </select>
                                 </td>
                                 <td style="padding-left: 4%">
                                  <select name="gender" style="display: inline;">
                                    <option value="select" selected>Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="both">Both</option>
                                    <option value="transgender">Transgender</option>
                                  </select>
                                 </td>
                                 <td style="padding-left: 4%">
                                  <select name="religion" style="display: inline;">
                                    <option value="select" selected>Select</option>
                                    <option value="buddhism">Buddhism</option>
                                    <option value="christian">Christian</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="jain">Jain</option>
                                    <option value="muslim">Muslim</option>
                                    <option value="parsi">Parsi</option>
                                    <option value="sikh">Sikh</option>
                                  </select>
                                </td>
                                <td style="padding-left: 4%">
                                  <select name="scholarship" style="display: inline;">
                                    <option value="select" selected>Select</option>
                                    <option value="merit">Merit Based</option>
                                    <option value="mean">Means Based</option>
                                    <option value="cultural">Cultural Talent</option>
                                    <option value="visual">Visual Art</option>
                                    <option value="sport">Sports Talent</option>
                                    <option value="science">Science, Maths Based</option>
                                    <option value="tech">Technology Based</option>
                                  </select>
                                </td>
                                <td style="padding-left: 4%">
                                  <input type="submit" id="apply" name="apply" value="Apply >">
                                </td>
                              </tr>
                        </form>
                      </tbody>
                    </table>
        </section>

          <!-- Two -->
            <section class="wrapper style4 container">
                <div class="content">
                  <section> <!-- start -->
                    <?php
                        $date1 =date("Y-m-d");
                        $class=$gender=$religion=$scholarship="";
                        $classflag=$genderflag=$religionflag=$scholarshipflag=0;
                        $text="All Scholarships";
                        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'){
                            if($_POST['class']!='select'){
                              $class=$_POST['class'];
                              $classflag=1;
                            }
                            if($_POST['gender']!='select'){
                              $gender=$_POST['religion'];
                              $genderflag=1;
                            }
                            if($_POST['religion']!='select'){
                              $religion=$_POST['religion'];
                              $religionflag=1;
                            }
                            if($_POST['scholarship']!='select'){
                              $scholarship=$_POST['scholarship'];
                              $scholarshipflag=1;
                            }
                            if($classflag==1 || $religionflag==1 || $genderflag==1 || $scholarshipflag==1){
                                $text="Filter Based Scholarships";
                            }
                        }
                    ?>
                    <h1><?php echo $text; ?></h1>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th style="width: 50%">Scholarship Name</th>
                                        <th>Description</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        if($classflag==1){   /* start4 */

                                          if($genderflag==1){   /* start3 */

                                            if($religionflag==1){ /* start2 */

                                              if($scholarshipflag==1) {/* start1 */
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$class' AND gender LIKE '$gender' AND religion LIKE '$religion' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                              } else{
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$class' AND gender LIKE '$gender' AND religion LIKE '$religion' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                              } /* end1 */
                                            } else{
                                              if($scholarshipflag==1){
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$class' AND gender LIKE '$gender' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                              } else{
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$class' AND gender LIKE '$gender' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                              }
                                            } /* end2 */
                                          } else{
                                            if($religionflag==1){

                                              if($scholarshipflag==1) {
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$class' AND religion LIKE '$religion' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                              } else{
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$class' AND religion LIKE '$religion' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                              } /* end1 */
                                            } else{
                                              if($scholarshipflag==1){
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$class' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                              } else{
                                                $to_query = "SELECT * FROM scholarship WHERE degree LIKE '$class' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                              }
                                            }
                                          }  /* end3 */
                                        } else{
                                           if($genderflag==1){

                                            if($religionflag==1){

                                              if($scholarshipflag==1) {
                                                $to_query = "SELECT * FROM scholarship WHERE gender LIKE '$gender' AND religion LIKE '$religion' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                              } else{
                                                $to_query = "SELECT * FROM scholarship WHERE gender LIKE '$gender' AND religion LIKE '$religion' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                              }
                                            } else{
                                              if($scholarshipflag==1){
                                                $to_query = "SELECT * FROM scholarship WHERE gender LIKE '$gender' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                              } else{
                                                $to_query = "SELECT * FROM scholarship WHERE gender LIKE '$gender' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                              }
                                            }
                                          } else{
                                            if($religionflag==1){

                                              if($scholarshipflag==1) {
                                                $to_query = "SELECT * FROM scholarship WHERE religion LIKE '$religion' AND sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                              } else{
                                                $to_query = "SELECT * FROM scholarship WHERE religion LIKE '$religion' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                              }
                                            } else{
                                              if($scholarshipflag==1){
                                                $to_query = "SELECT * FROM scholarship WHERE sch LIKE '$scholarship' AND adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                              } else{
                                                $to_query = "SELECT * FROM scholarship WHERE adminapproval LIKE 'Approved' AND appDeadline >= '$date1'";
                                              }
                                            }
                                          }
                                        } /* end4 */
                                        $sql_result = mysqli_query($conn, $to_query);
                                        while($row=mysqli_fetch_row($sql_result)){
                                          ?>
                                          <tr>
                                            <td><a href="tempschdesc.php?sch=<?php echo $row[0]?>" title="<?php echo $row[2]?>"><?php echo $row[2]; ?></td>
                                            <td><?php echo $row[12]; ?></td>
                                          </tr>
                                          <?php
                                        }
                                        ?>
                                    </tbody>
                                  </table
                  </section> <!-- end -->
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
    <!-- jQuery -->
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

    <script type="text/javascript">
    $(document).ready(function(){
      $("#applyBtn").click(function(){
        $("#applyModal").modal();
        });
    });
    </script>

  </body>
</html>
