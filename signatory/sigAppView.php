<?php

  session_start();

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
                  <li><a href = "tempSigApplication.php">Pending applications</a></li>
                  <li><a href = "tempSigApplication.php">Reviewed Applicaitons</a></li>
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
    	<?php
    	try{
    		/*If the view button was clicked*/
  		if (isset($_POST['view']) AND $_POST['view'] == 'View'){
        ?>
          <h1 style="text-align:center; font-size:25px">Application Details</h1>
        <?php
          $appID = $_POST['appID'];
          $sql = "SELECT * FROM application WHERE applicationID='$appID'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        ?>
        <table class="table">
            <tr>
                <th style="width:50%"><b>Application ID</b></th>
                <td><?php echo $row['applicationID']; ?></td>
            </tr>
            <tr>
                <th style="width:50%"><b>Student ID</b></th>
                <td><?php echo $row['studentID']; ?></td>
            </tr>
            <tr>
                <th style="width:50%"><b>Signatory ID</b></th>
                  <td><?php echo $row['sigID']; ?></td>
            </tr>
            <tr>
                <th style="width:50%"><b>Scholarship ID</b></th>
                <td><?php echo $row['scholarshipID']; ?></td>
            </tr>
            <tr>
                <th style="width:50%"><b>App Date</b></th>
                <td><?php echo $row['appDate']; ?></td>
            </tr>
            <tr>
                <th style="width:50%"><b>App Status</b></th>
                <td><?php echo $row['appstatus']; ?></td>
            </tr>
            <tr>
                <th style="width:50%"><b>verifiedBySignatory</b></th>
                <td><?php echo $row['verifiedBySignatory']; ?></td>
            </tr>
            <tr>
              <th><b>Uploaded Files : </b></th>
              <td>
                <button id="showapp" value="showapp" onclick="viewapp()">Show</button>
                <button id="hideapp" value="hideapp" onclick="hideapp()" style="display: none;">Hide</button>
              </td>
            </tr>
          </table>
          <section id="files" style="display: none;">
              <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width:3%">File Name </th>
                        <th style="width:3%"></th>
                    </tr>
                </thead>
                <tbody>
            <?php
      			$schID=$_POST['schID'];
      			$studentID=$_POST['studentID'];
      			$folder=$studentID."_".$schID;
      			$dir = "../applications/$folder/";
      			// Open a directory, and read its contents
      			if (is_dir($dir)){
      				$i=0;
      			  if ($dh = opendir($dir)){
      			    while (($file = readdir($dh)) !== false){
      			    	if($i>1){
      	    ?>
      						<tr><td><?php echo $file; ?></td><td>
      								<form action="<?php echo $dir."".$file ;?>" method="post" target="_blank">
                          <button name="view" value="view">View</button>
      			          </form>
      			      </td>
            <?php
      			      }
      			     	$i +=1;
      			    }
      			    closedir($dh);
      			  }
      	    ?>
      	    <?php } else { ?>
          			<script>
          				alert("Error! File View Failed!");
          				location.replace("tempSigApplication.php");
          			</script>
      		  <?php
      			}
            ?>
          </tbody></table>
          </section><br>
          <section style="text-align:center">
            <form name="blockform" method="post" action="../backend/sigBlockUnblockApp.php" onsubmit="confirmblock(this,'This will Block corresponding Application.\n Are your Sure?')" >
              <input type="hidden" name="appID" value="<?php echo $appID; ?>">
              <input type="submit"  name="blk_unblk_app" id="blockapp" value="blockapp" <?php if($row['appstatus'] === "inactive"){
                echo " style = 'color:#fff;display:none'";
              } ?>>
            </form><br>

            <form name="unblockform" action="../backend/sigBlockUnblockApp.php" onsubmit="confirmunblock(this,'This will Unblock corresponding Application.\n Are your Sure?')"  method="post">
              <input type="hidden" name="appID" value="<?php echo $appID; ?>">
              <input type="submit" name="blk_unblk_app" id="unblockapp" value="unblockapp" <?php if($row['appstatus'] !== 'inactive'){
                echo " style = 'color:#fff;display:none;'";
              } ?>>
            </form>
          </section>
            <?php
            }
          }
    		}
    	} catch(PDOException $e){
    		echo $e->getMessage();
    	}
      ?>
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
    function viewapp(){
      var showapp=document.getElementById("showapp");
      var hideapp=document.getElementById("hideapp");
      var schview=document.getElementById("files");
      schview.style.display = 'block';
      hideapp.style.display = 'inline';
      showapp.style.display = 'none';
    }

    function hideapp(){
      var showapp=document.getElementById("showapp");
      var hideapp=document.getElementById("hideapp");
      var schview=document.getElementById("files");
      schview.style.display = 'none';
      hideapp.style.display = 'none';
      showapp.style.display = 'inline';
    }

    function confirmblock(form,str){
      if(confirm(str)){
        document.blockform.submit();
      } else{
        event.preventDefault();
      }
    }
    function confirmunblock(form,str){
      if(confirm(str)){
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
