<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
        // Declaration
        $email = $_POST["edit_email"];
        $product = array();
        //Working
        $sql = "SELECT name,gender,phone,dob,address,country,dp FROM signup_table WHERE email='$email'";
        if ($result = $conn->query($sql)) {
            if(mysqli_num_rows($result)>0)
            {
                $row = mysqli_fetch_row($result);
        		$temp = array();
        		$temp['name'] = $row[0];
        		$temp['gender'] = $row[1];
        		$temp['phone'] = $row[2];
        	    $temp['phone'] = hex2bin($temp['phone']);
        		$temp['dob'] = $row[3];
        		$temp['address'] = $row[4];
        		$temp['country'] = $row[5];
        		$temp['dp'] = $row[6];
        		array_push($product, $temp);
        		unset($temp);
        		echo json_encode($product);
            }
            else
            {
                echo 'false';
            }
        } else {
            echo "Retrieving Error!";
        }
    }
    else
    {
        echo "Failed to connecting database!";
    }
    $conn->close();
?>

