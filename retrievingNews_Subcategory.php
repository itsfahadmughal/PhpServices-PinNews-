<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
        $no = $_POST["number"];
        $no_date = $_POST["number_date"];
        
        $no = (int)$no;
        $no_date = (int)$no_date;

        $sub_bool = false;
        $date_bool = false;

        $sub_category_name = array();
        $sub_category_name_date = array();

        for($i=0;$i<$no;$i++)
        {
            $sub_category_name[$i] = $_POST["sub_category_name".$i];
            $sub_bool = true;
        }   

        for($i=0;$i<$no_date;$i++)
        {
            $sub_category_name_date[$i] = $_POST["sub_category_name_date".$i];
            $date_bool = true;
        }

        $product = array();
        $sql = "";
        $category="sports";


        //Check both sub_category + date
        if ($sub_bool && $date_bool) {
            # code...
            for($i = 0; $i < $no; $i++)
            {           
                if(strcasecmp($sub_category_name[$i], "cricket")==0)
                {
                    $sql = "SELECT title, image,content, likes, share, date_entry, category, news_channel, view FROM all_news WHERE category='$category' AND lower(title) LIKE '%cricket%' OR '%bat%' OR '%batsman%' OR '%bouncer%' OR '%bail%' OR '%boundry%' OR '%bowler%' OR '%carrom ball%' OR '%century%' OR '%cover point%' OR '%doosra%' OR '%duck%' OR '%crease%' OR '%extar cover%' OR '%fast bowler%' OR '%fine leg%' OR '%follow_on%' OR '%full toss%' OR '%gully%' OR '%googly%' OR '%hit wicket%' OR '%leg break%' OR '%no_ball%' OR '%odi%' OR '%t200%' OR '%off break%' OR '%reverse swing%' OR '%stump%' OR '%yorker%' OR '%twenty20%' OR '%wicketkeeper%' OR '%icc%' 
                        OR 
                        lower(content) LIKE '%cricket%' OR '%bat%' OR '%batsman%' OR '%bouncer%' OR '%bail%' OR '%boundry%' OR '%bowler%' OR '%carrom ball%' OR '%century%' OR '%cover point%' OR '%doosra%' OR '%duck%' OR '%crease%' OR '%extar cover%' OR '%fast bowler%' OR '%fine leg%' OR '%follow_on%' OR '%full toss%' OR '%gully%' OR '%googly%' OR '%hit wicket%' OR '%leg break%' OR '%no_ball%' OR '%odi%' OR '%t200%' OR '%off break%' OR '%reverse swing%' OR '%stump%' OR '%yorker%' OR '%twenty20%' OR '%wicketkeeper%' OR '%icc%' AND title<>'Image News!' GROUP BY title HAVING date_entry IN ('".implode("','",array_map(null, $sub_category_name_date))."') ";
                }
                else if(strcasecmp($sub_category_name[$i], "hockey")==0)
                {
                    $sql = "SELECT title, image,content, likes, share, date_entry, category, news_channel, view FROM all_news WHERE category='$category' AND lower(title) LIKE '%hockey%' OR '%bully%' OR '%dribble%' OR '%hit%' OR '%obstruction%' OR '%penalty stroke%' OR '%scoop%' OR '%stick%' OR lower(content) LIKE '%hockey%' OR '%bully%' OR '%dribble%' OR '%hit%' OR '%obstruction%' OR '%penalty stroke%' OR '%scoop%' OR '%stick%'
                    OR 
                    lower(content) LIKE '%hockey%' OR '%bully%' OR '%dribble%' OR '%hit%' OR '%obstruction%' OR '%penalty stroke%' OR '%scoop%' OR '%stick%' OR lower(content) LIKE '%hockey%' OR '%bully%' OR '%dribble%' OR '%hit%' OR '%obstruction%' OR '%penalty stroke%' OR '%scoop%' OR '%stick%' AND title<>'Image News!'  GROUP BY title HAVING date_entry IN ('".implode("','",array_map(null, $sub_category_name_date))."') ";
                }
                else if(strcasecmp($sub_category_name[$i], "football")==0)
                {
                    $sql = "SELECT title, image,content, likes, share, date_entry, category, news_channel, view FROM all_news WHERE category='$category' AND lower(title) LIKE '%football%' OR '%fifa%' OR '%real madrid%' OR '%manchestar united%' OR '%tottenham hostspur%' OR '%celtic%' OR '%england national football%' OR '%wolverhamp wanderers%' OR '%kick%' OR '%handball%' OR '%kicker%' OR '%ronaldo%' OR '%messi%' OR lower(content) LIKE '%football%' OR '%fifa%' OR '%real madrid%' OR '%manchestar united%' OR '%tottenham hostspur%' OR '%celtic%' OR '%england national football%' OR '%wolverhamp wanderers%' OR '%kick%' OR '%handball%' OR '%kicker%' OR '%ronaldo%' OR '%messi%'
                        OR lower(content) LIKE '%football%' OR '%fifa%' OR '%real madrid%' OR '%manchestar united%' OR '%tottenham hostspur%' OR '%celtic%' OR '%england national football%' OR '%wolverhamp wanderers%' OR '%kick%' OR '%handball%' OR '%kicker%' OR '%ronaldo%' OR '%messi%' OR lower(content) LIKE '%football%' OR '%fifa%' OR '%real madrid%' OR '%manchestar united%' OR '%tottenham hostspur%' OR '%celtic%' OR '%england national football%' OR '%wolverhamp wanderers%' OR '%kick%' OR '%handball%' OR '%kicker%' OR '%ronaldo%' OR '%messi%'  AND title<>'Image News!' GROUP BY title HAVING date_entry IN ('".implode("','",array_map(null, $sub_category_name_date))."') ";
                }
                else if(strcasecmp($sub_category_name[$i], "kabaddi")==0)
                {
                    $sql = "SELECT title, image,content, likes, share, date_entry,  category, news_channel, view FROM all_news WHERE category='$category' AND lower(title) LIKE '%kabaddi%' OR '%raid%' OR '%super tackle%' OR '%do or die raid%' OR '%pursuit%' OR '%cant%' OR 
                    lower(content) LIKE '%kabaddi%' OR '%raid%' OR '%super tackle%' OR '%do or die raid%' OR '%pursuit%' OR '%cant%'  AND title<>'Image News!' GROUP BY title HAVING date_entry IN ('".implode("','",array_map(null, $sub_category_name_date))."') ";
                }
                else if(strcasecmp($sub_category_name[$i], "badminton")==0)
                {
                    $sql = "SELECT title, image,content, likes, share, date_entry, category, news_channel, view FROM all_news WHERE category='$category' AND lower(title) LIKE '%badminton%' OR '%alley%' OR '%long service line%' OR '%net short%' OR '%racket%' OR '%smash%' OR '%wood shot%' OR '%shuttlecock%' OR '%smash%' OR '%rally%' OR '%service%' OR 
                        lower(content) LIKE '%badminton%' OR '%alley%' OR '%long service line%' OR '%net short%' OR '%racket%' OR '%smash%' OR '%wood shot%' OR '%shuttlecock%' OR '%smash%' OR '%rally%' OR '%service%' AND title<>'Image News!'  GROUP BY title HAVING date_entry IN ('".implode("','",array_map(null, $sub_category_name_date))."') ";
                }
                else
                {
                    echo "Failed";
                }
                
            }

        }

        //Check sub_category
        else if ($sub_bool && !$date_bool) {
            # code...
            for($i = 0; $i < $no; $i++)
            {           
                if(strcasecmp($sub_category_name[$i], "cricket")==0)
                {
                    $sql = "SELECT title, image,content, likes, share, date_entry, category, news_channel, view FROM all_news WHERE category='$category' AND lower(title) LIKE '%cricket%' OR '%bat%' OR '%batsman%' OR '%bouncer%' OR '%bail%' OR '%boundry%' OR '%bowler%' OR '%carrom ball%' OR '%century%' OR '%cover point%' OR '%doosra%' OR '%duck%' OR '%crease%' OR '%extar cover%' OR '%fast bowler%' OR '%fine leg%' OR '%follow_on%' OR '%full toss%' OR '%gully%' OR '%googly%' OR '%hit wicket%' OR '%leg break%' OR '%no_ball%' OR '%odi%' OR '%t200%' OR '%off break%' OR '%reverse swing%' OR '%stump%' OR '%yorker%' OR '%twenty20%' OR '%wicketkeeper%' OR '%icc%' 
                        OR 
                        lower(content) LIKE '%cricket%' OR '%bat%' OR '%batsman%' OR '%bouncer%' OR '%bail%' OR '%boundry%' OR '%bowler%' OR '%carrom ball%' OR '%century%' OR '%cover point%' OR '%doosra%' OR '%duck%' OR '%crease%' OR '%extar cover%' OR '%fast bowler%' OR '%fine leg%' OR '%follow_on%' OR '%full toss%' OR '%gully%' OR '%googly%' OR '%hit wicket%' OR '%leg break%' OR '%no_ball%' OR '%odi%' OR '%t200%' OR '%off break%' OR '%reverse swing%' OR '%stump%' OR '%yorker%' OR '%twenty20%' OR '%wicketkeeper%' OR '%icc%' AND title<>'Image News!' ";
                }
                else if(strcasecmp($sub_category_name[$i], "hockey")==0)
                {
                    $sql = "SELECT title, image,content, likes, share, date_entry, category, news_channel, view FROM all_news WHERE category='$category' AND lower(title) LIKE '%hockey%' OR '%bully%' OR '%dribble%' OR '%hit%' OR '%obstruction%' OR '%penalty stroke%' OR '%scoop%' OR '%stick%' OR lower(content) LIKE '%hockey%' OR '%bully%' OR '%dribble%' OR '%hit%' OR '%obstruction%' OR '%penalty stroke%' OR '%scoop%' OR '%stick%'
                    OR 
                    lower(content) LIKE '%hockey%' OR '%bully%' OR '%dribble%' OR '%hit%' OR '%obstruction%' OR '%penalty stroke%' OR '%scoop%' OR '%stick%' OR lower(content) LIKE '%hockey%' OR '%bully%' OR '%dribble%' OR '%hit%' OR '%obstruction%' OR '%penalty stroke%' OR '%scoop%' OR '%stick%' AND title<>'Image News!' ";
                }
                else if(strcasecmp($sub_category_name[$i], "football")==0)
                {
                    $sql = "SELECT title, image,content, likes, share, date_entry, category, news_channel, view FROM all_news WHERE category='$category' AND lower(title) LIKE '%football%' OR '%fifa%' OR '%real madrid%' OR '%manchestar united%' OR '%tottenham hostspur%' OR '%celtic%' OR '%england national football%' OR '%wolverhamp wanderers%' OR '%kick%' OR '%handball%' OR '%kicker%' OR '%ronaldo%' OR '%messi%' OR lower(content) LIKE '%football%' OR '%fifa%' OR '%real madrid%' OR '%manchestar united%' OR '%tottenham hostspur%' OR '%celtic%' OR '%england national football%' OR '%wolverhamp wanderers%' OR '%kick%' OR '%handball%' OR '%kicker%' OR '%ronaldo%' OR '%messi%'
                        OR lower(content) LIKE '%football%' OR '%fifa%' OR '%real madrid%' OR '%manchestar united%' OR '%tottenham hostspur%' OR '%celtic%' OR '%england national football%' OR '%wolverhamp wanderers%' OR '%kick%' OR '%handball%' OR '%kicker%' OR '%ronaldo%' OR '%messi%' OR lower(content) LIKE '%football%' OR '%fifa%' OR '%real madrid%' OR '%manchestar united%' OR '%tottenham hostspur%' OR '%celtic%' OR '%england national football%' OR '%wolverhamp wanderers%' OR '%kick%' OR '%handball%' OR '%kicker%' OR '%ronaldo%' OR '%messi%'  AND title<>'Image News!' ";
                }
                else if(strcasecmp($sub_category_name[$i], "kabaddi")==0)
                {
                    $sql = "SELECT title, image,content, likes, share, date_entry,  category, news_channel, view FROM all_news WHERE category='$category' AND lower(title) LIKE '%kabaddi%' OR '%raid%' OR '%super tackle%' OR '%do or die raid%' OR '%pursuit%' OR '%cant%' OR 
                    lower(content) LIKE '%kabaddi%' OR '%raid%' OR '%super tackle%' OR '%do or die raid%' OR '%pursuit%' OR '%cant%'  AND title<>'Image News!' ";
                }
                else if(strcasecmp($sub_category_name[$i], "badminton")==0)
                {
                    $sql = "SELECT title, image,content, likes, share, date_entry, category, news_channel, view FROM all_news WHERE category='$category' AND lower(title) LIKE '%badminton%' OR '%alley%' OR '%long service line%' OR '%net short%' OR '%racket%' OR '%smash%' OR '%wood shot%' OR '%shuttlecock%' OR '%smash%' OR '%rally%' OR '%service%' OR 
                        lower(content) LIKE '%badminton%' OR '%alley%' OR '%long service line%' OR '%net short%' OR '%racket%' OR '%smash%' OR '%wood shot%' OR '%shuttlecock%' OR '%smash%' OR '%rally%' OR '%service%' AND title<>'Image News!'";
                }
                else
                {
                    echo "Failed";
                }
                
            }
        }
        
        //Check date
        else if (!$sub_bool && $date_bool) {
            $sql = "SELECT title, image,content, likes, share, date_entry, category, news_channel, view FROM all_news WHERE title != 'Image News!' AND date_entry IN ('".implode("','",array_map(null, $sub_category_name_date))."') ";
        }

        //Check none
        else if (!$sub_bool && !$date_bool) {
            // echo "false";
            $sql="nothing";
        }

        if ($sql=="nothing") {
            echo "false";
        }
        else {
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
    }
    else
    {
        echo "Failed to connecting database!";
    }
    $conn->close();
?>