<!DOCTYPE html>
<html>
<body>
<?php
    session_start();

    try
    {
        $flag = 1;
        $DBH = new PDO("mysql:host=localhost:3309;dbname=sms", "root", "");

        $email = $_POST['email'];
        $pass = $_POST['password'];

        $data = array('email' => $email);

        $STH = $DBH->prepare("SELECT * FROM (SELECT studentID AS ID, upMail, password, status, 1 AS roleID FROM student UNION SELECT adminID AS ID, upMail, password, status, 2 AS roleID FROM admin UNION SELECT sigID AS ID, upMail, password, status, 3 AS roleID FROM signatory) t WHERE upMail = :email");
        $STH->execute($data);
        $users = $STH->fetchAll(PDO::FETCH_OBJ);


        if(isset($users[0]) AND password_verify($_POST['password'], $users[0]->password))
        {
          if($users[0]->status == 'active'){

            $_SESSION['email'] = $users[0]->upMail;
            //User type -- 1 (student), 2(admin), 3(sig)
            $_SESSION['currentUserTYPE'] = $users[0]->roleID;
            $_SESSION['currentUserID'] = $users[0]->ID;
            $_SESSION['isLoggedIn'] = TRUE;

            $sql = $DBH->prepare("SELECT * FROM verify_signup WHERE upMail = :email");
            $sql->execute($data);
            $user_verify = $sql->fetchAll(PDO::FETCH_OBJ);
            if(isset($user_verify[0]) AND ($user_verify[0]->action == 0)){
              $flag = 0;
              ?>
                 <script type="text/javascript">
                    alert("YOU NEED TO VERIFY EMAIL ADDRESS TO ACTIVATE YOUR ACCOUNT!");
                    location.replace("verify_signupcode.php");
                </script>
              <?php
            }
          } else{
              $flag = 0;
              $_SESSION['errMsg'] = "Your Account is currently in INACTIVE Mode!";
              header('Location: ../index.php');
          }
        }
        $DBH = null;
        if($flag != 0){
          if ($_SESSION['currentUserTYPE'] == 1) header('Location: ../student/tempUserHome.php');
          elseif ($_SESSION['currentUserTYPE'] == 2) header('Location: ../admin/tempAdmin.php');
          elseif ($_SESSION['currentUserTYPE'] == 3) header('Location: ../signatory/tempSigHome.php');
          else {
            $_SESSION['errMsg'] = "UserName or Password Incorrect!";
            header('Location: ../index.php');
          }
        }
    } catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?>
</body>
</html>
