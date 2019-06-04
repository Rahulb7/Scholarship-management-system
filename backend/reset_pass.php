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
    $sql = "SELECT * FROM reset_password WHERE upMail = '".$email."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        if($row['num'] == $num){
          ?>
          <form action = "updatepassword.php" method="post" >
            Enter New Password : <input type="text" name="pass">
            Confirm New Password : <input type="text" name="repass">
            <input type="submit" value="Submit" name="submit">
          </form>

          <?php
        }
      }
    }
  }else{
  ?>
  <form action = "<?php $_SERVER['PHP_SELF'] ?>" method="post" >
    Enter Six Digit Code : <input type = "text" name = "sixdn">
    <input type="submit" value="Submit" name="submit">
  </form>
  <?php
  }
}catch(Exception $e){}
 ?>
</body>
</html>
