<?php

	$con = new mysqli("localhost","id8482197_idiotsthree","pakistan143" ,"id8482197_db");
	$email = $_POST["email"];
	$na = $_POST["national"];
	$op = $_POST["opinion"];
	$bu = $_POST["business"];
	$in = $_POST["international"];
	$la = $_POST["lahore"];
	$is = $_POST["islamabad"];
	$ka = $_POST["karachi"];
	$sp = $_POST["sports"];
	$li = $_POST["lifestyle"];
	$sn = $_POST["snippet"];


	$query = "UPDATE category_table SET category_nationalNation='$na', category_opinionNation='$op', category_businessNation='$bu', category_internationalNation='$in', category_metropolitan_lahoreNation='$la', category_metropolitan_islamabadNation='$is', category_metropolitan_karachiNation='$ka', category_sportsNation='$sp', category_lifestyleNation='$li', category_snippetNation='$sn' WHERE email='$email'";

	$res = mysqli_query($con, $query);

	if($res == true)
	{
		echo "Updated";
	}
	else
	{
		echo "Failed! Try Again.";
	}
?>