<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
        // Declaration
        $email = $_POST["em"];
        $password = $_POST["pwd"];
        $salt = sha1(md5($password));
        $password = md5($password.$salt);
        $product = array();
        $count = 0;
        
        //Working
        $sql = "SELECT name,dp FROM signup_table WHERE email='$email' AND password='$password'";
        if ($result = $conn->query($sql)) {
            if(mysqli_num_rows($result)>0)
            {
                $row = mysqli_fetch_row($result);
                $temp = array();
                $temp['runningname'] = $row[0];
                $temp['runningdp'] = $row[1];
                array_push($product, $temp);
                unset($temp);
            }
            else
            {
                echo 'Username or Password is not correct!';
                $count = 1;
            }
        } else {
            echo "Retrieving Error!";
        }
        if($count==0)
        {
            echo json_encode($product);
        }
    }
    else
    {
        echo "Failed to connecting database!";
    }
    $conn->close();
?>