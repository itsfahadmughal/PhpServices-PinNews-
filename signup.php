<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
    	// Declaration
	    $n = $_POST["name"];
		$e = $_POST["email"];
		$g = $_POST["gender"];
		$dob = $_POST["dob"];
		$a = $_POST["address"];
		$c = $_POST["country"];
		$dp = $_POST["displayPicture"];

		$p = $_POST["password"];
	    $salt = sha1(md5($p));
	    $p = md5($p.$salt);
		
		$ph = $_POST["phone"];
	    $ph = bin2hex($ph);

	    // Working
    	$sql = "INSERT INTO signup_table(name, email, password, gender, phone, dob, address, country, dp) SELECT * FROM (SELECT '$n', '$e', '$p', '$g', '$ph', '$dob', '$a', '$c', '$dp') AS tmp WHERE NOT EXISTS (SELECT email FROM signup_table WHERE email = '$e') LIMIT 1";
    	
        if ($conn->query($sql) === TRUE) {
            echo "Data Inserted Successfully!!!";
        } else {
            echo "Failed! Try Again.";
        }
    }
    else
    {
        echo "Failed to connecting database!";
    }
    $conn->close();
?>