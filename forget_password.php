<?php
    if(file_exists("config_file.php") && is_readable("config_file.php") && include("config_file.php")) 
    {
        $receiver = $_POST["email"];
        $subject = "PINNEWS Account Mail Authentication Code";
        $otp_code_signin = $_POST["otp_code"];
        $message = 'Dear User, to ensure that it is your own operation, the authetication identity of the authentication code is obtained through the mail address. Verification Code: '.$otp_code_signin.' Do not forward this code to anyone for security purposes.';
        $headers = 'From => pinnews.pk@gmail.com';

        mail($receiver, $subject, $message, $headers);
        echo $otp_code_signin;
    }
    else
    {
        echo "Failed to connecting database!";
    }
    $conn->close();
?>