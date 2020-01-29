<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
        // Declaration
        $email = mysqli_real_escape_string($conn,$_POST["email"]);
        $title = mysqli_real_escape_string($conn,$_POST["title"]);
        $category = mysqli_real_escape_string($conn,$_POST["category"]);
        
        $sql = "UPDATE all_news SET view = (view+1) WHERE title='$title' AND category='$category' ";
        if(mysqli_query($conn, $sql)){ 
            echo "done";
        } else { 
            echo "ERROR: Could not able to execute $sql. ".mysqli_error($conn); 
        }  
    }
    else
    {
        echo "Failed to connecting database!";
    }
    $conn->close();
?>