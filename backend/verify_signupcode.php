<!DOCTYPE html>
<html>
 <body>

<?php
session_start();

try
{
  if(isset($_POST['submit'])){
    $num = $_POST['sixdn'];
    $conn = new mysqli("localhost","root", "","sms");

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM verify_signup WHERE upMail = '".$email."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        if($row['num'] == $num){
          $update = "UPDATE verify_signup SET action = 1 WHERE upMail = '".$email."'";
          if(mysqli_query($conn, $update)){
        ?>
          <script type="text/javascript">
            alert("EMail Verified ! Please login");
            location.replace("../index.php");
          </script>
        <?php
          }
        }
        else{
          ?>
            <script type="text/javascript">
              alert("Incorrect credentials");
              location.replace("verify_signupcode.php");
            </script>
          <?php
        }
      }
    }
  }

  ?>

  <form action = "<?php $_SERVER['PHP_SELF'] ?>" method="post" >
    Enter Six Digit Code : <input type = "text" name = "sixdn">
    <input type="submit" value="Submit" name="submit">
  </form>

  <?php
}catch(Exception $e){}

 ?>
</body>
</html>
