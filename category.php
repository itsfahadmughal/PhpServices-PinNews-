<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
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
    	
    	$sql = "INSERT INTO category_table(email, category_nationalNation, category_opinionNation, category_businessNation, category_internationalNation, category_metropolitan_lahoreNation, category_metropolitan_islamabadNation, category_metropolitan_karachiNation, category_sportsNation, category_lifestyleNation, category_snippetNation) VALUES('$email', '$na', '$op', '$bu', '$in', '$la', '$is', '$ka', '$sp', '$li', '$sn')";
    	
        if ($conn->query($sql) === TRUE) {
            echo "inserted";
        } else {
            echo "Error Submitting Feedback: " . $conn->error;
        }
    }
    else
    {
        echo "Failed to connecting database!";
    }
    $conn->close();
?>

