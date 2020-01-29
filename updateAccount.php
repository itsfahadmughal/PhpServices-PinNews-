<?php

    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
    	$email = $_POST["editEmail"];
    	$choice = $_POST["account"];
    	$sql = "";
    	
    	switch($choice)
    	{
            case "name":
                $name = $_POST["editName"];
                $sql = "UPDATE signup_table SET name='$name' WHERE email='$email'";        
                break;
            case "location":
                $address = $_POST["editAddress"];
                $country = $_POST["editCountry"];    
                $sql = "UPDATE signup_table SET address='$address',country='$country' WHERE email='$email'";       
                break;
            case "dob":
                $dob = $_POST["editDob"];
                $sql = "UPDATE signup_table SET dob='$dob' WHERE email='$email'";
                break;
            case "gender":
                $gender = $_POST["editGender"];
                $sql = "UPDATE signup_table SET gender='$gender' WHERE email='$email'";
                break;
            case "phone":
                $phone = $_POST["editPhone"];
                $phone = bin2hex($phone);
                $sql = "UPDATE signup_table SET phone='$phone' WHERE email='$email'";
                break;
            case "password":
                $password = $_POST["editPassword"];
                $salt = sha1(md5($password));
                $password = md5($password.$salt);
                $sql = "UPDATE signup_table SET password='$password' WHERE email='$email'";
                break;
            case "dp":
                $dp = $_POST["editDp"];
                $sql = "UPDATE signup_table SET dp='$dp' WHERE email='$email'";
                break;
            default:
                $sql = "";
    	}
    	
        if ($conn->query($sql) === TRUE) {
            echo "Updated";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    else
    {
        echo "Failed to connecting database!";
    }
    $conn->close();
?>