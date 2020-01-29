<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
        // Declaration
    	$email = $_POST["email"];
    	$pass = array("facebook","google");
        $pass_converted = array();
        $count = 0;

        //Working
    	$sql = "SELECT password FROM signup_table WHERE email='$email'";
        if ($result = $conn->query($sql)) {
            if(mysqli_num_rows($result)>0)
            {
                while($row = $result->fetch_assoc()) {
                    $password = $row["password"];
                }

                for ($i=0; $i < count($pass); $i++) {     
                    $salt = sha1(md5($pass[$i]));
                    $pass_converted[$i] = md5($pass[$i].$salt);
                    if ($password == $pass_converted[$i]) {
                        echo $pass[$i];
                        break;
                    }
                    $count++;
                }
                if ($count == 2) {
                    echo "create";
                }
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
