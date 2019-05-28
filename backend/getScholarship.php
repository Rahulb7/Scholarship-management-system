<?php
	function getScholarship(){
		$DBH = new PDO("mysql:host=localhost;dbname=sms", "root", "");

		$data = array('id' => $_SESSION['scholarship']);

		$STH = $DBH->prepare("SELECT * FROM scholarship WHERE scholarshipID = :id");

		$STH->execute($data);
		$scholarships = $STH->fetchAll(PDO::FETCH_OBJ);

		$DBH = null;
		return $scholarships[0];
	}
?>
