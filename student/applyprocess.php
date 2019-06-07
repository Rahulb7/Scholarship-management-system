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
      <link href="../css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="../css/main.css" rel="stylesheet">
  </head>
  <body class = "no-sidebar">
      <script type="text/javascript">
          function fileValidation(name){
              var fileInput = document.getElementById(name);
              var filePath = fileInput.value;
              var allowedExtensions = /(\.pdf)$/i;  //  /(\.jpg|\.jpeg|\.png|\.gif)$/i
              if(!allowedExtensions.exec(filePath)){
                  alert('Please upload file having extensions .pdf only.');
                  fileInput.value = '';
                  return false;
              }else if(fileInput.files[0].size > 8000000){
                alert('File size too large');
                  fileInput.value = '';
                  return false;
              }
              else{ }
          }
          </script>


    <div id = "page-wrapper">

      <!-- Header -->
        <header id = "header">
          <h1 id = "logo"><a href = "javascript:history.back()" class="button special">Back</a></h1>
          <nav id = "nav">
            <ul>
              <li><a href = "tempUserHome.php">Home</a></li>
              <li><a href = "tempUserProfile.php">User Profile</a></li>
              <li class = "current"><a href = "tempUserApply.php">Apply</a></li>
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
            <h2>SUPPORTING DOCUMENTS</h2>
          </header>

            <section class="wrapper style4 container">
              <h1>Please Submit all the Documents as mentioned below.</h1>
              <h1><b>NOTE : </b>The documents must be of the format- <u><b>PDF</b></u></h1><br>
              <form action="../backend/userdocupload.php" method="post" enctype="multipart/form-data">

                  <label><b>1. <u>Aadhar Card : </u></b></label>
                  <label>This must contain two copies of AADHAR Card, both front and back side copy.Collate into one pdf and upload it HERE(MAX SIZE : 800kb)<span style="color: red">*</span> </label>
                  <input type="file"  name="file[]" id="aadharcard" onchange=" return fileValidation('aadharcard')" required><br>

                  <!-- <hr> not working -->
                  <label>_____________________________________________________________________________________________________________________________________</label><br><br>

                  <label><b>2. <u> Fee Receipt : </u></b></label>
                  <label>This must contain Receipt of the fees of entire year(Collate into one pdf if you have more than one document) and upload it HERE(MAX SIZE : 800kb)<span style="color: red">*</span> </label>
                  <input type="file"  name="file[]" id="feereceipt" onchange=" return fileValidation('feereceipt')" required><br>

                  <!-- <hr> not working -->
                  <label>_____________________________________________________________________________________________________________________________________</label><br><br>

                  <label><b>3. <u> First Page of Saving Account Passbook : </u></b></label>
                  <label>This must contain first page of your saving account passbook.Deatils such as your fullname, IFSC code, bank account number, branch name must be clearly visible in the document (MAX SIZE : 800kb)<span style="color: red">*</span> </label>
                  <input type="file"  name="file[]" id="passbook" onchange="return fileValidation('passbook')" required><br><br>

                  <input type="submit" name="apply" value="Apply >>">

              </form>
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
