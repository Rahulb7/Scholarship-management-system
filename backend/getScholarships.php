<?php 
	function getScholarships(){
		$DBH = new PDO("mysql:host=localhost:3309;dbname=sms", "root", "");

		$STH = $DBH->prepare("SELECT * FROM scholarship");

		$STH->execute();
		$scholarships = $STH->fetchAll(PDO::FETCH_OBJ);

		$DBH = null;
		return $scholarships;
	}
?>