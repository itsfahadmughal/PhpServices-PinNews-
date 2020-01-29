<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
        // Functions Declaration

        // Function # 1 (Get Number of Pages)
        function getNoOfPages($url,$city)
        {
            // Fetching URL
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $html = curl_exec($ch);
            curl_close($ch);
        
            $DOM=new DOMDocument;
            libxml_use_internal_errors(true);
            $DOM->loadHTML($html);
        
            // Getting value by tag name.
            $elements=$DOM->getElementsByTagName('select');
            $temp="";
                
            if(preg_match('/[^<select name="epaper_city" id="epaper_edition" style="">(.*)<\/select>]+/', $elements->item(1)->getAttribute('name'), $match)){
            $temp = $elements->item(1)->nodeValue;
            }
        
                $z=preg_replace('/[^A-Za-z|-]/', '', $temp);
                $temp3=explode("-", $z);
                $result = array_map('strtolower', $temp3);                              // Converting to lower
                
                for ($l=0; $l < count($result); $l++) { 
                    if ($result[$l]=='foreign') {
                        $result[$l]='';
                    }
                }
                $result=array_values(array_filter($result));
                // Changing Name to Table name
                for ($i=0; $i < count($result) ; $i++) { 
                    # code...
                    if ($result[$i] == 'frontpage' || $result[$i] == 'national' || $result[$i] == 'backpage' || $result[$i] == 'adguide') {
                        $result[$i] = 'national';
                    }
                    elseif ($result[$i] == 'opinions') {
                        $result[$i] = 'opinion';
                    }
                    elseif ($result[$i] == 'business') {
                        $result[$i] = 'business';
                    }
                    elseif ($result[$i] == 'international') {
                        $result[$i] = 'international';
                    }
                    elseif ($result[$i] == 'city') {
                        $result[$i] = $city;
                    }
                    elseif ($result[$i] == 'sports') {
                        $result[$i] = 'sports';
                    }
                    elseif ($result[$i] == 'lifestyleentertainment') {
                        $result[$i] = 'lifestyle';
                    }
                    elseif ($result[$i] == 'snippets') {
                        $result[$i] = 'snippet';
                    }
                }
                return $result;
        }   // Function # 1 end

        // Function # 2
        function getNoOfDetail($page_no, $date, $city)
        {
            $detail = 0;
            $context = stream_context_create(array('http' => array('ignore_errors' => true),));
        
            // Iteration of pages (approx 22)
            for ($i=0; $i < 25; $i++) { 
                # code...
                $string_file=file_get_contents('https://nation.com.pk/E-Paper/'.$city.'/'.$date.'/page-'.$page_no.'/detail-'.$detail, false, $context);
                $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $string_file, $matches) ? $matches[1] : null;
                if ($title=='404 Page') {
                    break;
                }
                else
                {
                    $detail++;
                }
            }
            return $detail-1;
        }   // Function # 2 ending

        //Function # 3
        function getValues($url)
        {
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $html = curl_exec($ch);
            curl_close($ch);
        
            $DOM=new DOMDocument;
            libxml_use_internal_errors(true);
            $DOM->loadHTML($html);
            $elements=$DOM->getElementsByTagName('p');
            $titles=$DOM->getElementsByTagName('title');

            //For Title
            for ($i=0; $i < $titles->length; $i++) { 
            # code...
                $s3[$i]=$titles->item($i)->nodeValue;
            }

            $title = implode("",$s3);   
            
            if($title == 'The Nation')
            {
                $title = 'Image News!';
            }

            
            // For Image
            $string_file=file_get_contents($url);
            preg_match('/ <img itemprop="image" id="news_detail_img_thumb" name="news_detail_img_thumb" border="0" src="(.*?).jpg" alt="epaper" \/> /  ', $string_file,$img);
    
            if(!isset($img[0]))
            {
                preg_match('/ <img id="news_detail_img_thumb" name="news_detail_img_thumb" border="0" src="(.*?).jpg" alt="epaper" \/> /  ', $string_file,$img2);
                $image_temp=$img2[0];
            }
            else
            {
                $image_temp=$img[0];
            }

            $doc = new DOMDocument();
            $doc->loadHTML($image_temp);
            $imageTags = $doc->getElementsByTagName('img');
            $image="";
            foreach($imageTags as $images) {
                $image = $images->getAttribute('src');
            }
            

            // For Content
            $s = array();
        
            for ($i=0; $i < $elements->length; $i++) { 
                # code...
                if(preg_match('/[^NIPCO House, 4 - Shaharah e Fatima Jinnah,lahore, Pakistan Tel: +92 42 36367580    |     Fax : +92 42 36367005]+/', $elements->item($i)->getAttribute('style'), $match)){
                    $s[$i] = $elements->item($i)->nodeValue."    ";
                }
            }
            $content = implode("",$s);
            if($content==null)
            {
                $content = 'No Detailed Content Available! Content is not available in either Newspaper';
            }
            return array($title,$image,$content);
        } // Ending of Function # 3

        // Function # 4
        function uploadNews($category,$title,$image,$content,$date)
        {
            include("config_file.php");
            $news_channel = "TheNation.com";
            $stmt =  $conn->stmt_init();
            $stmt->prepare("INSERT INTO all_news(title,image,content,likes,share,view,total_rating,date_entry,category,news_channel) VALUES(?,?,?,0,0,0,0,?,?,?)");
            for($k=0;$k<count($title);$k++)
            {
                
                $stmt->bind_param('ssssss',$title[$k],$image[$k],$content[$k],$date,$category,$news_channel);
                $stmt->execute();
            }
            $stmt->close();
        }   // Function # 4 ending


        // Declaration //,"islamabad","karachi","kpk"
        $cities = array("lahore");
        date_default_timezone_set("Asia/Karachi");
        $currentDate = date("Y-m-d");
    

        $nop = array();
        $title = array();
        $image = array();
        $content = array();

        // Working
        for ($i=0; $i < count($cities); $i++) { 
            # code...
            $dummy_url = "https://nation.com.pk/E-Paper/$cities[$i]/$currentDate";
            $nop = getNoOfPages($dummy_url,$cities[$i]);

            for ($j=0; $j < count($nop); $j++) 
            { 
                # code...
                $nod = getNoOfDetail($j+1,$currentDate,$cities[$i]);
                // Detail Loop
                for ($k=0; $k < $nod; $k++) 
                {    
                    # code...
                    $url = 'https://nation.com.pk/E-Paper/'.$cities[$i].'/'.$currentDate.'/page-'.($j+1).'/detail-'.$k;  //1x0
                    list($title[$k],$image[$k],$content[$k]) = getValues($url);
                }
                uploadNews($nop[$j],$title,$image,$content,$currentDate);       // category, title, image, content, date
                unset($title);
                unset($image);
                unset($content);
            }
        }
    }
    else
    {
        echo "Failed to connecting database!";
    }
    $conn->close();
?>