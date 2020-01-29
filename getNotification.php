<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {

	    $product = array();
		
		$sql = "SELECT DISTINCT title, image, content, date_entry, category, news_channel FROM notification_table ORDER BY date_entry DESC";
		if ($result = $conn->query($sql)) {
            if(mysqli_num_rows($result)>0)
            {
                while($row = mysqli_fetch_row($result)) {
                    $temp2 = array();
                    $temp2['title'] = $row[0];
                    $temp2['image'] = $row[1];
                    $temp2['content'] = $row[2];
                    $temp2['date_entry'] = $row[3];
                    $temp2['category'] = $row[4];
                    $temp2['news_channel'] = $row[5];
                    array_push($product, $temp2);
                    unset($temp2);    
                }
            }
            else
            {
                echo 'false';
            }
        } else {
            echo "Retrieving Error!";
        }
        echo json_encode($product);
    }
    else
    {
        echo "Failed to connecting database!";
    }
    $conn->close();
?>