<!--
 The MIT License (MIT)
 Copyright (c) 2016 UPSMS
 Authors:
   Back-End Developer: Patricia Regarde


 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:
 The above copyright notice and this permission notice shall be included in all
 copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 SOFTWARE.

 This is a course requirement for CS 192 Software Engineering II under the
 supervision of Asst. Prof. Ma. Rowena C. Solamo of the Department of Computer
 Science, College of Engineering, University of the Philippines, Diliman for
 the AY 2015-2016

 Code History:
  March 8, 2016: Patricia Regarde added the login functionality for the system. System can now recognize user IDs 
                  for all types of users.
  March 14, 2016: Patricia Regarde fixed a bug where login redirects to signatory page when email is not in database.
                  Added error message.

  File Creation Date: March 8, 2016
  Development Group: UPSMS (Marbille Juntado, Patricia Regarde, Cyan Villarin)
  Client Group: Mrs. Rowena Solamo, Dr. Jaime Caro
  Purpose of this software: Our main goal is to implement a system that allows the monitoring of scholarship system within UP System.
-->

<?php
    session_start();

    try
    {
        
        $DBH = new PDO("mysql:host=localhost:3309;dbname=sms", "root", "");

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