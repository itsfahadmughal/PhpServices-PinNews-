<?php
	# code...
$date="25_04_2019";
$date2="2019_04_25";
	for ($i=176; $i <=178; $i++) { 
		# code...
		for ($j=1; $j < 12; $j++) {
		if ($i>=150) {
			# code...
		$url='https://epaper.dawn.com/DetailImage.php?StoryImage='.$date.'_'.
		$i.'_00'.$j;
		list($title[$j],$image[$j],$content[$j])=abc($url);
		}else if ($j>=10) {
			# code...
			$url='https://epaper.dawn.com/DetailImage.php?StoryImage='.$date.'_00'.
			$i.'_0'.$j;
			list($title[$j],$image[$j],$content[$j])=abc($url);
		}else if ($i>=150&&$j>=10) {
			# code...
			$url='https://epaper.dawn.com/DetailImage.php?StoryImage='.$date.'_'.
			$i.'_0'.$j;
			list($title[$j],$image[$j],$content[$j])=abc($url);
		}else{
		$url='https://epaper.dawn.com/DetailImage.php?StoryImage='.$date.'_'.
		$i.'_00'.$j;
		list($title[$j],$image[$j],$content[$j])=abc($url);	
		}
	}
		//uploadNews('category_dawnMetropolitan_lahore',$title,$image,$content,$date2);       // tablename, title, image, content
		unset($title);
        unset($image);
        unset($content);
}


function abc($url){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$html = curl_exec($ch);
	curl_close($ch);

	$DOM=new DOMDocument;
	libxml_use_internal_errors(true);
	$DOM->loadHTML($html);

	
	$title=""; //title
	$contents=""; //content
	
	$p='/<img[^>]+>/';
	$m=array();
	preg_match_all($p, $html, $m);
	$image=explode('"', $m[0][9]);
	if ($image[1]=='https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=1DJ3k1acFH00UN') {
		# code...
		$image[1]="http://www.houseofpakistan.com/wp-content/uploads/2015/07/daily_dawn.jpg";
	}

echo"-------------------------------------------image---------------------------------------------------------------";
	print_r($image[1]);
	
	echo"-------------------------------------------Title---------------------------------------------------------------";
	//get title and content
	$titles=$DOM->getElementsByTagName('title');
	$content=$DOM->getElementsByTagName('div');
	for ($i=0; $i < $titles->length; $i++) { 
		$title=substr($titles->item($i)->nodeValue,0,strlen($titles->item($i)->nodeValue)-20);
		if ($title=="") {
			# code...
			continue;
		}else{
			echo $title;
		}
		  
	}   
	echo"-------------------------------------------Content---------------------------------------------------------------";
	for ($i=20; $i < 21; $i++) { 
		$contents=$content->item($i)->nodeValue;
		if ($contents=="") {
			# code...
			continue;
		}else{
			echo $contents;
		}
	}
	 return array($title,$image[1],$contents);
}

//uploading the news.
/*
function uploadNews($tablename,$title,$image,$content,$date_t)
    {
        $con = new mysqli("localhost","id8482197_idiotsthree","pakistan143" ,"id8482197_db");
        $stmt =  $con->stmt_init();
        $a = "Dawn.com";
        $stmt->prepare("INSERT INTO $tablename(title, image, content, likes, share,view,total_rating,date_entry,newstag) VALUES(?,?,?,0,0,0,0,?,?)");
        for($k=0;$k<count($title);$k++)
        {
            
            $stmt->bind_param('sssss',$title[$k],$image[$k],$content[$k],$date_t,$a);
            $stmt->execute();
            
        }
        $stmt->prepare("DELETE FROM $tablename WHERE title = '' ");
        $stmt->execute();
        $stmt->close();
    }   // Function # 6 ending
*/
?>