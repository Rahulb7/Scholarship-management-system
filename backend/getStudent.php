<?php
    function getStudent()
    {
        $DBH = new PDO("mysql:host=localhost;dbname=sms", "root", "");

		$data = array('id' => $_SESSION['student']);

        $STH = $DBH->prepare("SELECT * FROM student WHERE studentID = :id");

        $STH->execute($data);
        $students = $STH->fetchAll(PDO::FETCH_OBJ);

        $DBH = null;

        return $students[0];
    }
?>
