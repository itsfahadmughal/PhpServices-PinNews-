<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
    	$email = $_POST["email"];
    	$stmt = $conn->prepare("SELECT category_nationalNation, category_opinionNation, category_businessNation, category_internationalNation, category_metropolitan_lahoreNation, category_metropolitan_islamabadNation, category_metropolitan_karachiNation, category_sportsNation, category_lifestyleNation, category_snippetNation  FROM category_table WHERE email='$email'");
	    $stmt->execute();
	    $stmt->bind_result($na,$op,$bu,$in,$ml,$mi,$mk,$sp,$li,$sn);
		$product = array();
		while ($stmt->fetch()) 
		{	
			$temp = array();
			if($na=='category_nationalNation')
			{
				array_push($temp, "national");
			}
			if ($op=='category_opinionNation') {
				array_push($temp, "opinion");
			}
			if ($bu=='category_businessNation') {
				array_push($temp, "business");
			}
			if ($in=='category_internationalNation') {
				array_push($temp, "international");
			}
			if ($ml=='category_metropolitan_lahoreNation') {
				array_push($temp, "lahore");
			}
			if ($mi=='category_metropolitan_islamabadNation') {
				array_push($temp, "islamabad");
			}
			if ($mk=='category_metropolitan_karachiNation') {
				array_push($temp, "karachi");
			}
			if ($sp=='category_sportsNation') {
				array_push($temp, "sports");
			}
			if ($li=='category_lifestyleNation') {
				array_push($temp, "lifestyle");
			}
			if ($sn=='category_snippetNation') {
				array_push($temp, "snippet");
			}
		}

		$noofcategoryselected = count($temp);
	    $product = array();
		
		$sql = "SELECT image FROM all_news WHERE title<>'Image News!' AND category IN ('".implode("','",array_map(null, $temp))."') ";
		if ($result = $conn->query($sql)) {
            if(mysqli_num_rows($result)>0)
            {
                while($row = mysqli_fetch_row($result)) {
                    $temp2 = array();
                    $temp2['image'] = $row[0];
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
		shuffle($product);
        echo json_encode($product);
    }
    else
    {
        echo "Failed to connecting database!";
    }
    $conn->close();
?>