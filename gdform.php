<?php
	$request_method = $_SERVER["REQUEST_METHOD"];
	if($request_method == "GET")
	{
		$query_vars = $_GET;
	} 
	elseif ($request_method == "POST")
	{
		$query_vars = $_POST;
	}
    reset($query_vars);
    
	$emailFile = $_SERVER['DOCUMENT_ROOT'] . "/../.gdForm_email_address.formmail";
    $emailAddress = file_get_contents($emailFile);
    $emailRegex = "/^[_a-z0-9-]+(.[a-z0-9-]+)@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,6})$/";

    if (preg_match($emailRegex, $emailAddress))
    {
        $host = $_SERVER['HTTP_HOST'];
        
        $messageBody = "";
        while (list ($key, $val) = each ($query_vars)) 
        {
            if ($key == "redirect") 
            { 
                $landing_page = $val;
            }
            elseif ($key == "subject")
            {
                $subject_string = $val;
            }
            else
            {
                $messageBody = $messageBody . "$key: $val\r\n";
            }
        }

        $subject = "$host - $subject_string";

        $messageBody = $messageBody . "\r\n-----------------------------------------------------------------";
        $messageBody = $messageBody . "\r\nThis e-mail was generated from a form submission on your website: " . $host;

        $headers = "From: formmailer@secureserver.net\r\n";
        mail($emailAddress, $subject, $messageBody, $headers);

        if ($landing_page != "")
        {
            header("Location: http://".$_SERVER["HTTP_HOST"]."/$landing_page");
        } 
        else 
        {
            header("Location: http://".$_SERVER["HTTP_HOST"]."/");
        }
    }
    else
    {
        echo "Email address listed on the server is invalid, cannot send.";
    }
?>
