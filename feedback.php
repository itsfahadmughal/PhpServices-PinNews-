<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
    	$email = $_POST["email_feedback"];
    	$feedback = $_POST["feedback"];
    	$date = $_POST["date"];
    	$sql = "INSERT INTO feedback_table(email, feedback, date) VALUES('$email', '$feedback', '$date')";
    	
        if ($conn->query($sql) === TRUE) {
            echo "Feedback Submitted! Thanks.";
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