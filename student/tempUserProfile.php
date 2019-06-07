<?php
  session_start();
  $_SESSION['selectedAppID'] = 0;
  $_SESSION['currentUserName'] = NULL;
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

    //Getting Name
    $getName = "select S.firstName, S.middleName, S.lastName from student S where S.studentID = '".$_SESSION['currentUserID']."'";
    $nameResult = mysqli_query($conn,$getName);
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


  $upMail=$firstName=$lastName=$middleName=$nationality=$gender=$birthPlace=$presStreetAddr=$presProvCity=$presRegion=$permProvCity=$permStreetAddr=$permRegion=$contactNo=$dept=$college=$birthDate= NULL;
  //Get User Details
  $sql = "SELECT * FROM student WHERE studentID = '".$_SESSION['currentUserID']."'";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()) {
    $upMail = $row["upMail"];
    $firstName = $row["firstName"];
    $lastName = $row["lastName"];
    $middleName = $row["middleName"];
    $nationality = $row["nationality"];
    $gender = $row["gender"];
    $birthDate = $row["birthDate"];
    $birthPlace = $row["birthPlace"];
    $presStreetAddr = $row["presStreetAddr"];
    $presProvCity = $row["presProvCity"];
    $presRegion = $row["presRegion"];
    $permStreetAddr = $row["permStreetAddr"];
    $permProvCity = $row["permProvCity"];
    $permRegion = $row["permRegion"];
    $contactNo = $row["contactNo"];
    $dept = $row["dept"];
    $college = $row["college"];
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
              <li class = "current"><a href = "tempUserProfile.php">User Profile</a></li>
              <li><a href = "tempUserApply.php">Apply</a></li>
              <li><a href = "tempUserView.php">View Scholarship Status</a></li>
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
                          <form method="post" action="../backend/userdata.php" class="form-horizontal" role="form">

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

                            <?php if($nationality==NULL || $nationality==""){} else{ ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="nationality">Nationality:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" value="<?php echo $nationality?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($gender==NULL || $gender==""){} else{ ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="gender">Gender:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" value="<?php echo $gender?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($birthDate==NULL || $birthDate=="0000-00-00"){} else{ ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="birthDate">Birthdate:</label>
                              <div class="col-sm-10">
                                <input type="date" class="form-control" value="<?php echo $birthDate?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($birthPlace==NULL || $birthPlace==""){} else{ ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="birthPlace">Birthplace:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" value="<?php echo $birthPlace?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($presStreetAddr==NULL || $presStreetAddr==""){} else{ ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="presStreetAddr">Present Street Address:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" value="<?php echo $presStreetAddr?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($presProvCity==NULL || $presProvCity==""){} else{ ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="presProvCity">Present City:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" value="<?php echo $presProvCity?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($presRegion==NULL || $presRegion==""){} else{ ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="presRegion">Present Region:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" value="<?php echo $presRegion?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($permStreetAddr==NULL || $permStreetAddr==""){} else{ ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="permStreetAddr">Permanent Street Address:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" value="<?php echo $permStreetAddr?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($permProvCity==NULL || $permProvCity==""){} else{ ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="permProvCity">Permanent City:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" value="<?php echo $permProvCity?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($permRegion==NULL || $permRegion==""){} else{ ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="permRegion">Permanent Region:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" value="<?php echo $permRegion?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($contactNo==NULL || $contactNo=="0"){} else{ ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="contactNo">Contact Number:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" value="<?php echo $contactNo?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($dept==NULL || $dept==""){} else{ ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="dept">Department:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" value="<?php echo $dept?>"disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <?php if($college==NULL || $college==""){} else{ ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="college">College:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" value="<?php echo $college?>" disabled>
                              </div>
                            </div>
                            <?php } ?>

                            <!--
                            <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default" id="submit" style="display: none;">Submit</button>
                              </div>
                            </div>

                          -->
                          </form>
                          <button id="showDivButton" style="margin:2% 0% 3% 42%;" type="button" class="btn btn-primary">Edit User Profile</button>
                      </div>

                      <div id="editDiv" style="display:none">
                          <form method="POST" action="../backend/userdata.php" class="form-horizontal" role="form">
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
                              <label class="control-label col-sm-2" for="nationality">Nationality:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="nationality" value="<?php echo $nationality?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="gender">Gender:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="gender" value="<?php echo $gender?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="birthDate">Birthdate:</label>
                              <div class="col-sm-10">
                                <input type="date" class="form-control" name="birthDate" value="<?php echo $birthDate?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="birthPlace">Birthplace:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="birthPlace" value="<?php echo $birthPlace?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="presStreetAddr">Present Street Address:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="presStreetAddr" value="<?php echo $presStreetAddr?>" >
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="presProvCity">Present City:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="presProvCity" value="<?php echo $presProvCity?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="presRegion">Present Region:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="presRegion" value="<?php echo $presRegion?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="permStreetAddr">Permanent Street Address:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="permStreetAddr" value="<?php echo $permStreetAddr?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="permProvCity">Permanent City:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="permProvCity" value="<?php echo $permProvCity?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="permRegion">Permanent Region:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="permRegion" value="<?php echo $permRegion?>" >
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="contactNo">Contact Number:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="contactNo" value="<?php if($contactNo!='0') { echo $contactNo; } ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="dept">Department:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="dept" value="<?php echo $dept ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="college">College:</label>
                              <div class="col-sm-10">
                                <input type="name" class="form-control" name="college" value="<?php echo $college?>">
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
      <script src="../js/jquery.min.js"></script>
      <script src="../js/jquery.dropotron.min.js"></script>
      <script src="../js/jquery.scrolly.min.js"></script>
      <script src="../js/jquery.scrollgress.min.js"></script>
      <script src="../js/skel.min.js"></script>
      <script src="../js/util.js"></script>
      <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
      <script src="../js/main.js"></script>


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
