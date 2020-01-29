<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
        // Declaration
        $email = mysqli_real_escape_string($conn,$_POST["email"]);
        $likes = mysqli_real_escape_string($conn,$_POST["likes"]);
        $title = mysqli_real_escape_string($conn,$_POST["title"]);
        $category = mysqli_real_escape_string($conn,$_POST["category"]);
        $c = mysqli_real_escape_string($conn,$_POST["like_checker"]);
        $sql = "";
        $sql3 = "";
        $product = array();
        
        //Working
        if($c=='do')
        {
            $sql = "UPDATE all_news SET likes = (likes+1) WHERE title='$title' AND category='$category' ";
        }
        else
        {
            $sql = "UPDATE all_news SET likes = (likes-1) WHERE title='$title' AND category='$category' ";   
        }

        if(mysqli_query($conn, $sql)){ 
            $sql2 = "SELECT * FROM like_history WHERE category = '$category' and title = '$title' ";
            $result = mysqli_query($conn, $sql2);
            if(mysqli_num_rows($result) > 0)
            {
                echo "Update";
                $sql3 = "UPDATE like_history SET likes = '$c' WHERE title = '$title' AND email='$email' AND category = '$category'";
            }
            else
            {
                echo "Insert";
                $sql3 = "INSERT INTO like_history(email, category, title, likes) VALUES('$email', '$category', '$title','$c')";
            }
            if (mysqli_query($conn, $sql3)) {
                echo "Successful";
            }
            else
            {
                echo "Error";
            }
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