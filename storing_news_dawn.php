<?php
	# code...
    
    date_default_timezone_set("Asia/Karachi");
    $date = date("d_m_Y");
    //$date = "28-04-2019";
    $date2 = date("Y-m-d");
    islamabadnews($date,$date2);
    karachinews($date,$date2);
	lahorenews($date,$date2);
	sportsnews($date,$date2);
	remainnews($date,$date2);

function remainnews($date,$date2){
	for ($i=1; $i <=14; $i++) { 
		# code...
		for ($j=1; $j < 12; $j++) {
		if ($i>=10) {
			# code...
		$url='https://epaper.dawn.com/DetailImage.php?StoryImage='.$date.'_0'.
		$i.'_00'.$j;
		list($title[$j],$image[$j],$content[$j])=abc($url);
		}else if ($j>=10) {
			# code...
			$url='https://epaper.dawn.com/DetailImage.php?StoryImage='.$date.'_00'.
			$i.'_0'.$j;
			list($title[$j],$image[$j],$content[$j])=abc($url);
		}else if ($i>=10&&$j>=10) {
			# code...
			$url='https://epaper.dawn.com/DetailImage.php?StoryImage='.$date.'_0'.
			$i.'_0'.$j;
			list($title[$j],$image[$j],$content[$j])=abc($url);
		}else{
		$url='https://epaper.dawn.com/DetailImage.php?StoryImage='.$date.'_00'.
		$i.'_00'.$j;
		list($title[$j],$image[$j],$content[$j])=abc($url);	
		}
	}
	if ($i<=7||$i==14) {
		# code...
		uploadNews('national',$title,$image,$content,$date2);       // tablename, title, image, content
	}else if ($i==8) {
		# code...
		uploadNews('editorial',$title,$image,$content,$date2);       // tablename, title, image, content
	}else if ($i==9) {
		# code...
		uploadNews('opinion',$title,$image,$content,$date2);       // tablename, title, image, content
	}
	else if ($i==10||$i==11) {
		# code...
		uploadNews('business',$title,$image,$content,$date2);       // tablename, title, image, content
	}else if ($i==12||$i==13) {
		# code...
		uploadNews('international',$title,$image,$content,$date2);       // tablename, title, image, content
	}else{

	}
		unset($title);
        unset($image);
        unset($content);
	}
}//remain news end...


function islamabadnews($date,$date2){
for ($i=151; $i <=153; $i++) { 
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
		uploadNews('islamabad',$title,$image,$content,$date2);       // tablename, title, image, content
		unset($title);
        unset($image);
        unset($content);
	}
}//isb end...

function karachinews($date,$date2){
	for ($i=115; $i <=117; $i++) { 
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
		uploadNews('karachi',$title,$image,$content,$date2);       // tablename, title, image, content
		unset($title);
        unset($image);
        unset($content);
	}
}//karachi end...

function lahorenews($date,$date2){
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
		uploadNews('lahore',$title,$image,$content,$date2);       // tablename, title, image, content
		unset($title);
        unset($image);
        unset($content);
	}
}//lahore end...

function sportsnews($date,$date2){
	for ($i=20; $i <=22; $i++) { 
		# code...
		for ($j=1; $j < 12; $j++) {
		if ($i>=20) {
			# code...
		$url='https://epaper.dawn.com/DetailImage.php?StoryImage='.$date.'_0'.
		$i.'_00'.$j;
		list($title[$j],$image[$j],$content[$j])=abc($url);
		}else if ($j>=10) {
			# code...
			$url='https://epaper.dawn.com/DetailImage.php?StoryImage='.$date.'_00'.
			$i.'_0'.$j;
			list($title[$j],$image[$j],$content[$j])=abc($url);
		}else if ($i>=20&&$j>=10) {
			# code...
			$url='https://epaper.dawn.com/DetailImage.php?StoryImage='.$date.'_0'.
			$i.'_0'.$j;
			list($title[$j],$image[$j],$content[$j])=abc($url);
		}else{
		$url='https://epaper.dawn.com/DetailImage.php?StoryImage='.$date.'_0'.
		$i.'_00'.$j;
		list($title[$j],$image[$j],$content[$j])=abc($url);	
		}
	}
		uploadNews('sports',$title,$image,$content,$date2);       // tablename, title, image, content
		unset($title);
        unset($image);
        unset($content);
	}
}//sportsnews end...

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

	print_r($image[1]);

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

function uploadNews($category,$title,$image,$content,$date_t)
    {
        include("config_file.php");
        $stmt =  $conn->stmt_init();
        $a = "Dawn.com";
        $stmt->prepare("INSERT INTO all_news(title, image, content, likes, share,view,total_rating,date_entry,category,news_channel) VALUES(?,?,?,0,0,0,0,?,?,?)");
        for($k=0;$k<count($title);$k++)
        {
            
            $stmt->bind_param('ssssss',$title[$k],$image[$k],$content[$k],$date_t,$category,$a);
            $stmt->execute();
            
        }
        $stmt->prepare("DELETE FROM all_news WHERE title = '' ");
        $stmt->execute();
        $stmt->close();
    }   // Function # 6 ending

?>