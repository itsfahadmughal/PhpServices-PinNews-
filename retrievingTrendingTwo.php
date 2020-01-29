<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
        $product = array();
        
        $sql = "UPDATE all_news SET total_rating=(likes+share+view)";
        if ($conn->query($sql) === TRUE) {
            $sql2 = "SELECT title, image, content, likes, share, date_entry, category, news_channel, total_rating, view FROM all_news WHERE title<>'Image News!' ORDER BY total_rating DESC";
            if ($result = $conn->query($sql2)) {
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
                }
                else
                {
                    echo 'false';
                }
            } else {
                echo "Retrieving Error!";
            }
            echo json_encode($product);

        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    else
    {
        echo "Failed to connecting database!";
    }
    $conn->close();
?>