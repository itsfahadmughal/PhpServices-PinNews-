<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
        // Declaration
        $email = mysqli_real_escape_string($conn,$_POST["email"]);
        $product = array();
        
        // Working
        $sql = "SELECT title,likes FROM like_history WHERE email='$email'";
        
        if ($result = $conn->query($sql)) {
            if(mysqli_num_rows($result)>0)
            {
                while($row = mysqli_fetch_row($result)) {
                    $temp = array();
                    $temp['title'] = $row[0];
                    $temp['likes'] = $row[1];
                    array_push($product, $temp);
                    unset($temp);
                }
                echo json_encode($product);
            }
            else
            {
                echo 'Not Found';
            }
        }
        else 
        {
            echo "Retrieving Error!";
        }
        
    }
    else
    {
        echo "Failed to connecting database!";
    }
    $conn->close();
?>