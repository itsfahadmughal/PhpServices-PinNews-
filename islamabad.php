<?php 

    // Declaration
    $cities = array("lahore","islamabad","karachi");
    
    date_default_timezone_set("Asia/Karachi");
    $today = date("Y-m-d"); 
    $date_t="2019-04-28";
    $url = 'https://nation.com.pk/E-Paper/islamabad/'.$date_t.'/page-1'; 
    
    //No of pages (nop)
    $nop = array();     //12
    $nop = getNoOfPages($url);

    $title = array();
    $image = array();
    $content = array();
    
    for($p=0;$p<count($nop);$p++)
    {
        if($nop[$p]=="category_metropolitan_islamabadNation")
	{
        $nod = getNoOfDetail($p+1,$date_t);
        // Detail Loop
        for ($j=0; $j < $nod; $j++) {       // 7
            # code...
            $url2 = 'https://nation.com.pk/E-Paper/islamabad/'.$date_t.'/page-'.($p+1).'/detail-'.$j;  //1x0
            list($title[$j],$image[$j],$content[$j]) = getValues($url2);
        }
        uploadNews($nop[$p],$title,$image,$content,$date_t);       // tablename, title, image, content
        unset($title);
        unset($image);
        unset($content);
	}
	else
	{
	    echo "continue";
	}

}
        
    
    echo "Done";

    
    
    
    
    
    // Functions
    
    //Function # 1
    function getNoOfPages($url1)
    {
        // Fetching URL
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url1);
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
            # code...
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
                $result[$i] = 'category_nationalNation';
            }
            elseif ($result[$i] == 'opinions') {
                $result[$i] = 'category_opinionNation';
            }
            elseif ($result[$i] == 'business') {
                $result[$i] = 'category_businessNation';
            }
            elseif ($result[$i] == 'international') {
                $result[$i] = 'category_internationalNation';
            }
            elseif ($result[$i] == 'city') {
                $result[$i] = 'category_metropolitan_islamabadNation';
            }
            elseif ($result[$i] == 'sports') {
                $result[$i] = 'category_sportsNation';
            }
            elseif ($result[$i] == 'lifestyleentertainment') {
                $result[$i] = 'category_lifestyleNation';
            }
            elseif ($result[$i] == 'snippets') {
                $result[$i] = 'category_snippetNation';
            }
        }
        return $result;
    }   // Function # 1 end
    



    // Function # 2
    function getNoOfDetail($nop2,$date_t)
    {
        $detail = 0;
        $context = stream_context_create(array('http' => array('ignore_errors' => true),));
    
        // Iteration of pages (approx 22)
        for ($i=0; $i < 30; $i++) { 
            # code...
            $string_file=file_get_contents('https://nation.com.pk/E-Paper/islamabad/'.$date_t.'/page-'.$nop2.'/detail-'.$detail, false, $context);
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
    function getValues($url2)
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url2);
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

        $image="";
        $p='/<img[^>]+>/';
        $m=array();
        preg_match_all($p, $html, $m);
        $s1=explode('"', $m[0][10]);
        if ($s1[7]=='0') {
            # code...
            $image=$s1[9];
        }else{
            $image=$s1[7];
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
    }
    
    
    
    // Function # 6
    function uploadNews($tablename,$title,$image,$content,$date_t)
    {
        $con = new mysqli("localhost","id8482197_idiotsthree","pakistan143" ,"id8482197_db");
        $stmt =  $con->stmt_init();
        $a = "TheNation.com";
        $stmt->prepare("INSERT INTO $tablename(title, image, content, likes, share,view,total_rating,date_entry,newstag) VALUES(?,?,?,0,0,0,0,?,?)");
        for($k=0;$k<count($title);$k++)
        {
            
            $stmt->bind_param('sssss',$title[$k],$image[$k],$content[$k],$date_t,$a);
            $stmt->execute();
            
        }
        $stmt->close();
    }   // Function # 6 ending


?>