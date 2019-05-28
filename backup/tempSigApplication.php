<?php

  session_start();

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

      <link href="css/bootstrap.min.css" rel="stylesheet">

      <link href="css/main.css" rel="stylesheet">

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
          <h1 id = "logo"><a href = "#">Scholarships <span>that matter</span></a></h1>
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
							<!-- Content -->
						<div class="content">
                            <div class="form-group">
                            <?php
                           		$sql="SELECT scholarshipID,schname FROM scholarship where sigID=$currentUserID";
					            $result = mysqli_query($conn,$sql);
                             ?>	
                              <label style="margin-left: 30%"><h2><b>Select Your Scholarship</b></h2></label>
                              <div class="col-sm-10"> 
                               <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" name="login" > 
                                <select name="class" id="class" onchange="viewcontent()" style="margin-left: 30%;padding-top: 1%;padding-bottom: 1%">

                                    <option value="select" selected>Select</option>
                            	<?php
                            		while($rows9=mysqli_fetch_row($result)){
                            			foreach ($rows9 as $key => $value){
	                            			if($key == 0)
              											{
              												$tempschid = $value;
              											}
              											
              											if($key == 1)
              											{
                            	?>	
                                    		<option value="<?php echo $tempschid;?>"><?php echo $value;?></option>
                                <?php
                                			}
                                		}
                                	}
                                ?>
                                  </select>
                                </form>
                              </div>
                            </div>
                            <br><br>

                          
                            <section id="application" style="display: none;">
                            	<?php $id="<span id='schid'></span>";
                            		echo $tempschid."<br>";
                            		echo $id;
                            		
                            		?>
							<h1><strong>Application of Scholarship ID :<?php echo $id;?> </strong></h1>
							
                          	<table class="table table-bordered">
                            	<thead>
                                	<tr>
                                  		<th style="width:3%">Application ID</th>
                                  		<th style="width:3%">Student ID</th>
                                  		<th style="width:3%">Scholarship ID</th>
                                  		<th style="width:8%">AppDate</th>
                                  		<th style="width:3%">Status</th>                                  		
                                  		<th style="width:3%">Verified By Signatory</th>
                                  		<th style="width:3%"></th>
                                  		<th style="width:3%"></th>
                                  		<th style="width:3%"></th>                                  		                                  		                                  		
                                	</tr>
                            	</thead>
                            	<tbody>
                                	<?php
                                	$con=new mysqli("localhost","root","","sms");
                                  	$queryScholarship = "SELECT * FROM `application` WHERE `scholarshipID`=$tempschid";
                                  	$qSchoResult = mysqli_query($con, $queryScholarship);

                                  	while($rows=mysqli_fetch_row($qSchoResult))
                                  	{
                                  		
                                    	foreach($rows as $key => $value){

	                                      	if ($key == 0){
	                                        	?> <tr ><td> <?php echo $value;
	                                      	}
	                                      	if ($key == 1){
	                                        	?> </td><td> <?php echo $value;
	                                      	}
	                                      	if ($key == 2){
	                                        	?> </td><td> <?php echo $value;
	                                      	}
	                                      	if ($key == 3){
	                                        	?> </td><td> <?php echo $value;
	                                      	}
	                                      	if ($key == 4){
	                                        	?> </td><td> <?php echo $value;
	                                      	}
	                                      	if($key == 5){
	                                      		?></td><td><?php echo $value;	                                      		
	                                      	}
                                    	}
                                    	?></td><td>
                                    			Approve
                                    		</td><td>
                                    			Reject
                                    		</td><td>
                                    			View
                                    		</td>
                                    	<?php
                                  	}
                                	?>		                                			                                
                            	</tbody>
                          	</table>
						</section>
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