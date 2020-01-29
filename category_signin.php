<?php
	if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
	{
        // Declaration
        $email = $_POST["email"];
        $temp = "";
        
        //Working
        $sql = "SELECT category_nationalNation, category_opinionNation, category_businessNation, category_internationalNation, category_metropolitan_lahoreNation, category_metropolitan_islamabadNation, category_metropolitan_karachiNation, category_sportsNation, category_lifestyleNation, category_snippetNation FROM category_table WHERE email='$email'";
        if ($result = $conn->query($sql)) {
            if(mysqli_num_rows($result)>0)
            {
                $row = mysqli_fetch_row($result);
                if($row[0]=='category_nationalNation'){
				    $temp = $temp.$row[0].',';
				}
				if ($row[1]=='category_opinionNation') {
				    $temp = $temp.$row[1].',';
				}
				if ($row[2]=='category_businessNation') {
				    $temp = $temp.$row[2].',';
				}
				if ($row[3]=='category_internationalNation') {
				    $temp = $temp.$row[3].',';
				}
				if ($row[4]=='category_metropolitan_lahoreNation') {
				    $temp = $temp.$row[4].',';
				}
				if ($row[5]=='category_metropolitan_islamabadNation') {
				    $temp = $temp.$row[5].',';
				}
				if ($row[6]=='category_metropolitan_karachiNation') {
				    $temp = $temp.$row[6].',';
				}
				if ($row[7]=='category_sportsNation') {
				    $temp = $temp.$row[7].',';
				}
				if ($row[8]=='category_lifestyleNation') {
				    $temp = $temp.$row[8].',';
				}
				if ($row[9]=='category_snippetNation') {
				    $temp = $temp.$row[9].',';
				}
				echo $temp;
            }
            else
            {
                echo 'false';
            }
        } 
        else 
        {
            echo "Retrieving Error!";
        }
	}
	else
	{
		echo "Failed to connecting database!";
	}
	$conn->close();
?>