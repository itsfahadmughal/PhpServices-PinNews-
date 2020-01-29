<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
        date_default_timezone_set("Asia/Karachi");
        $date = date("Y-m-d");
		$sql = "INSERT INTO notification_table (title,image,content,date_entry, category, news_channel) SELECT DISTINCT title, image, content, date_entry, category, news_channel FROM all_news WHERE title<>'Image News!' AND date_entry = '$date' ORDER BY total_rating DESC limit 10";
		if ($conn->query($sql) === TRUE) {
		    echo "Inserted successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
    }
    else
    {
        echo "Failed to connecting database!";
    }
    $conn->close();
?>