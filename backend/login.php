<?php
    session_start();

    try
    {

        $DBH = new PDO("mysql:host=localhost:3306;dbname=sms", "root", "");

        $email = $_POST['email'];
        $pass = $_POST['password'];

        $data = array('email' => $email);

        $STH = $DBH->prepare("SELECT * FROM (SELECT studentID AS ID, upMail, password, 1 AS roleID FROM student UNION SELECT adminID AS ID, upMail, password, 2 AS roleID FROM admin UNION SELECT sigID AS ID, upMail, password, 3 AS roleID FROM signatory) t WHERE upMail = :email");
        $STH->execute($data);
        $users = $STH->fetchAll(PDO::FETCH_OBJ);


        if(isset($users[0]) AND password_verify($_POST['password'], $users[0]->password))
        {

            $_SESSION['email'] = $users[0]->upMail;
            //User type -- 1 (student), 2(admin), 3(sig)
            $_SESSION['currentUserTYPE'] = $users[0]->roleID;
            $_SESSION['currentUserID'] = $users[0]->ID;
            $_SESSION['isLoggedIn'] = TRUE;

        }


        $DBH = null;

        if ($_SESSION['currentUserTYPE'] == 1) header('Location: ../tempUserHome.php');
        elseif ($_SESSION['currentUserTYPE'] == 2) header('Location: ../tempAdmin.php');
        elseif ($_SESSION['currentUserTYPE'] == 3) header('Location: ../tempSigHome.php');
        else {
          $_SESSION['errMsg'] = "User not found!";
          header('Location: ../index.php');
        }


    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?>
