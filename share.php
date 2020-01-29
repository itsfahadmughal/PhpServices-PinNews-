<?php

	$con = new mysqli("localhost","id8482197_idiotsthree","pakistan143" ,"id8482197_db");
	$s = $_POST["share"];
	$t = $_POST["title"];
	
	
	$table = array("category_nationalNation","category_opinionNation", "category_businessNation", "category_internationalNation", "category_metropolitan_lahoreNation", "category_metropolitan_islamabadNation", "category_metropolitan_karachiNation", "category_sportsNation", "category_lifestyleNation", "category_snippetNation");

	for ($h=0; $h < 10; $h++) { 
	
		$q= "SELECT * FROM ".$table[$h]." WHERE title = '$t' ";
		$res = mysqli_query($con, $q);
		if ($res == true) {
		    echo "come in";
			$query = "UPDATE ".$table[$h]." SET share = '$s' WHERE title='$t'";		
			$res2 = mysqli_query($con,$query);
			if($res2==true)
			{
			    echo "done";
			}
			else
			{
			    echo "error inner";
			}
		}
		else
		{
		    echo "outer error";
		}
	}

?>