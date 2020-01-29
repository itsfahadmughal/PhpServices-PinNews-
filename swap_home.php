<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
        $email = $_POST["email"];
        $title = $_POST["title"];
        $date = $_POST["date"];
        $category = $_POST["category"];
        $news_channel = $_POST["news_channel"];

        $product = array();
        $temp = array();
        
        $sql = "SELECT title FROM all_news WHERE title<>'Image News!' AND category = '".$category."' AND date_entry = '".$date."' AND NOT news_channel = '".$news_channel."' ";
        if ($result = $conn->query($sql)) {
            if(mysqli_num_rows($result)>0)
            {
                $i = 0;
                while($row = mysqli_fetch_row($result)) {
                    $temp[$i] = $row[0];
                    $i = $i + 1;
                }
            }
            else
            {
                echo 'no';
            }
        } else {
            echo "Retrieving Error!";
        }

        // Matching Titles
        $n = count($temp); 
        $temp2 = array();
        for($j = 0; $j < $n; $j++)
        {
            similar_text($temp[$j], $title,$temp2[$j]);
        }

        $max_title_index = array_search(max($temp2), $temp2);
        $max_title_percentage = max($temp2);

        if ($max_title_percentage > 70) {
            # code...
            $sql2 = "SELECT title, image, content, likes, share, date_entry, category, news_channel, view FROM all_news WHERE title = '$temp[$max_title_index]' AND category = '".$category."' AND date_entry = '".$date."' AND NOT news_channel = '".$news_channel."' ";
            if ($result2 = $conn->query($sql2)) 
            {
                if(mysqli_num_rows($result2)>0)
                {
                    while($row2 = mysqli_fetch_row($result2)) {
                        $temp2 = array();
                        $temp2['title'] = $row2[0];
                        $temp2['image'] = $row2[1];
                        $temp2['content'] = $row2[2];
                        $temp2['likes'] = $row2[3];
                        $temp2['share'] = $row2[4];
                        $temp2['date_entry'] = $row2[5];
                        $temp2['category'] = $row2[6];
                        $temp2['news_channel'] = $row2[7];
                        $temp2['view'] = $row2[8];
                        array_push($product, $temp2);
                        unset($temp2);   
                    }
                    echo json_encode($product);
                }
                else
                {
                    echo 'no';
                }
            } else {
                echo "Retrieving Error!";
            }
        }
        else
        {
            echo "no";
        }
    }
    else
    {
        echo "Failed to connecting database!";
    }
    $conn->close();
?>