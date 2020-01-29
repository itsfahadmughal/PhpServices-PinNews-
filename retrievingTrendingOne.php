<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
        $product = array();
        
        $sql = "SELECT title, image, content, likes, share, date_entry, category, news_channel, view FROM all_news WHERE title<>'Image News!' ORDER BY date_entry DESC";
        if ($result = $conn->query($sql)) {
            if(mysqli_num_rows($result)>0)
            {
                while($row = mysqli_fetch_row($result))
                {
                    $temp2 = array();
                    $temp2['title'] = $row[0];
                    $temp2['image'] = $row[1];
                    $temp2['content'] = $row[2];
                    $temp2['likes'] = $row[3];
                    $temp2['share'] = $row[4];
                    $temp2['date_entry'] = $row[5];
                    $temp2['category'] = $row[6];
                    $temp2['news_channel'] = $row[7];
                    $temp2['view'] = $row[8];
                    array_push($product, $temp2);
                    unset($temp2);
                }
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