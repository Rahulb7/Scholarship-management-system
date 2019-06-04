<?php session_start();
    require 'PHPMailer\PHPMailerAutoload.php';
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

      <meta name="description" content="">
      <meta name="author" content="">


      <title>Signatory Signup</title>

      <link href="css/bootstrap.min.css" rel="stylesheet">
      <!-- <link href="css/login.css" rel="stylesheet"> -->

    <!-- Custom Google Web Font -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Exo:100,200,400' rel = 'sylesheet' type = 'text/css'>

    <!-- Custom CSS-->
    <link href="css/general.css" rel="stylesheet">

    <!-- Owl-Carousel -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <script src="js/modernizr-2.8.3.min.js"></script>  <!-- Modernizr /-->
  </head>

  <body id = "home">

    <?php
      $email=NULL;
      $flag=1;
      try{
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (!empty($_POST["email"]) && !empty($_POST["password"])) {

            $email = $_POST['email'];
            $pass = $_POST['password'];
             $cpass = $_POST['confirm_password'];
            if(strcmp($pass, $cpass)!=0){
              $flag=-1;
            }
            $conn = new mysqli("localhost:3309","root", "","sms");

            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT upMail FROM student UNION SELECT upMail FROM signatory";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                if($row["upMail"]==$email){
                  $flag=0;
                }
              }
            }
            if($flag==0){
              $_SESSION['errMsg'] = "User Already Exists!";

            }else if($flag==-1){
               $_SESSION['errMsg'] = "Password and Confirm Password donot match";
            }
            else{
              //Convert password into hash
              $phash=password_hash($pass, PASSWORD_DEFAULT);

              // Write insert query
              $sql="INSERT INTO signatory(upMail,password) VALUES ('$email','$phash')";
              if (mysqli_query($conn, $sql)) {
                $min = 100001;
                $max = 999999;
                $sixdigitnum = mt_rand ( $min ,  $max );
                $verify="INSERT INTO verify_signup(upMail,num) VALUES ('$email','$sixdigitnum')";
                if(mysqli_query($conn, $verify)){
                  $emailfrom = "bindrani.rb7@gmail.com";
                  $passfrom = "8128962439rb";
                  $mail = new PHPMailer;
                  $mail->isSMTP();                            // Set mailer to use SMTP
                  $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
                  $mail->SMTPAuth = true;                     // Enable SMTP authentication
                  $mail->Username = $emailfrom;                   // SMTP username
                  $mail->Password = $passfrom; 			              // SMTP password
                  $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
                  $mail->Port = 587;                          // TCP port to connect to

                  $mail->setFrom($emailfrom, 'SMS');
                  $mail->addReplyTo($emailfrom, 'SMS');
                  $mail->addAddress($email);                  // Add a recipient
                  // $mail->addCC('cc@example.com');
                  // $mail->addBCC('bcc@example.com');
                  $mail->isHTML(true);  // Set email format to HTML

                  $bodyContent = '

                  Thanks for signing up!
                  <h1>Your account has been created</h1>You can <strong>login</strong> with the following credentials after you have activated your account by pressing the url below.


                  Use the following code to Login To Our WebSite:<br/>'.$sixdigitnum.'<br/><br/>
                  Thank You For Using Our WebSite!
                  '; // Our message above including the
                  $mail->Subject = 'Signup | Verification';
                  $mail->Body    = $bodyContent;

                  if(!$mail->send()) {
                      echo 'Mailer Error: ' . $mail->ErrorInfo;
                  } else {
                    $_SESSION['email'] = $email;

                  ?>
                    <script type="text/javascript">
                      alert("Your Account Has been Created, Please check your Email for verification!");
                      location.replace("backend/verify_signupcode.php")
                    </script>
                  <?php
                  }
                }
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
              }
            }
            $conn->close();
          }
        }
      }
      catch(Exception $e)
      {
        echo $e->getMessage();
      }
    ?>

    <div class = "intro-header">
      <div class = "col-xs-12 text-center">
        <h1 class = "h1_home wow fadeIn" data-wow-delay = "0.4s">SMS</h1>
        <h3 class = "h3_home wow fadeIn" data-wow-delay = "0.6s">Scholarship Management System </h3>
        <h3 class = "h3_home wow fadeIn" data-wow-delay = "0.6s">Signatory Signup</h3>
        <h3 class = "h3_home wow fadeIn" data-wow-delay = "0.6s">Create Your Account</h3>

        <div class="login">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" name="login" >
            <input type="email" name="email" class = "h3_home wow fadeIn" data-wow-delay = "0.8s" value="<?php echo $email ?>" placeholder="Enter Email Address" required autofocus>

            <input type="password" name="password" id="password" class = "h3_home wow fadeIn" data-wow-delay = "1.0s" placeholder="Enter Password" required>

            <input type="password" name="confirm_password" id="confirm_password" class = "h3_home wow fadeIn" data-wow-delay = "1.2s" placeholder="Confirm Password" required>

            <input type = "submit" id="submit" class = "btn btn-lg mybutton_standard wow swing wow fadeIn network-name text-center" data-wow-delay="1.2s">

            <h5 class = "h3_home wow fadeIn" data-wow-delay = "1.4s">Already have an Account<a style="color:white" href="index.php">&nbsp;&nbsp;<u>Click Here</u></a></h5>

            <h5 class = "h3_home wow fadeIn" data-wow-delay = "1.6s">Signup as a<a style="color:white" href="signup_sig.php">&nbsp;&nbsp;Student</u></a></h5>
          </form>

          <?php
            if(!empty($_SESSION['errMsg'])){ ?>
              <div class = "wow fadeIn" data-wow-delay = "1.8s">
                <div class="alert alert-danger wow swing text-center" data-wow-delay="2.2s" style="margin-top:20px;">
                  <center><strong>Invalid! </strong><?php echo $_SESSION['errMsg']; ?></center>
                </div>
              </div>
          <?php unset($_SESSION['errMsg']); }?>
        </div>
     </div>
    </div>


    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/script.js"></script>
    <!-- StikyMenu -->
    <script src="js/stickUp.min.js"></script>
    <script type="text/javascript">
      jQuery(function($) {
      $(document).ready( function() {
        $('.navbar-default').stickUp();

      });
      });

      //Checking Password and Confirm Password
     /* function check_pass(){
        if(document.getElementById("password").value == document.getElementById("confirm_password").value){
          document.getElementById("submit").disabled=false;
        }
        else{
          document.getElementById("submit").disabled=true;
        }
      }*/

    </script>
    <!-- Smoothscroll -->
    <script type="text/javascript" src="js/jquery.corner.js"></script>
    <script src="js/wow.min.js"></script>
    <script>
     new WOW().init();
    </script>
    <script src="js/classie.js"></script>
    <script src="js/uiMorphingButton_inflow.js"></script>
    <!-- Magnific Popup core JS file -->
    <script src="js/jquery.magnific-popup.js"></script>

  </body>
</html>
