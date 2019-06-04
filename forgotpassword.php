<?php session_start();
  require 'PHPMailer\PHPMailerAutoload.php';
 ?>
<!DOCTYPE html>
<html>
<body>

  <?php
    if(isset($_POST['submit'])){
      $email = $_POST['email'];
      $conn = new mysqli("localhost","root", "","sms");

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT upMail,1 AS role FROM student WHERE upMail = '".$email."' UNION SELECT upMail,2 AS role FROM signatory WHERE upMail = '".$email."'";
      try{
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              $_SESSION['role'] = $row["role"];
          }
          $min = 100001;
          $max = 999999;
          $sixdigitnum = mt_rand ( $min ,  $max );
          $verify="INSERT INTO reset_password(upMail,num) VALUES ('$email','$sixdigitnum')";
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

            Hey There,
            <h1>We have got a Password Reset Request for your Account</h1><br/>

            Use the following code to Reset Password :<br/>'.$sixdigitnum.'<br/><br/>
            Thank You For Using Our WebSite!
            '; // Our message above including the
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = $bodyContent;

            if(!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
              $_SESSION['email'] = $email;
              ?>
                <script type="text/javascript">
                  alert("Please check your Email for Password Reset!");
                  location.replace("backend/reset_pass.php")
                </script>
              <?php
              }
            }

        }else{?>
          <script type="text/javascript">
            alert("Account Doesnt Exists Please Signup First");
            location.replace('signup.php');
          </script><?php
        }
      }catch(Exception $e){}
    }else{
   ?>
  <form action = "<?php $_SERVER['PHP_SELF'] ?>" method="post">
    Enter your Email ID :
    <input type="text" name="email">
    <br/><input type="submit" name="submit" value="Send Code">
  </form>
<?php } ?>
</body>
</html>
