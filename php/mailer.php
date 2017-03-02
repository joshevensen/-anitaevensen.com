<?php
if( isset($_POST) ){

    //form validation vars
    $formok = true;
    $errors = array();

    //email info
    $EmailTo    = "anita@even7.com";
    $Subject    = "Contact Form Submission";

    //submission data
    $date = date('m/d/Y');
    $time = date('H:i');

    //form data
    function check_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $Name  		= check_input($_POST['name']);
    $Email 		= check_input($_POST['email']);
    $Details	    = check_input($_POST['message']);
    // honeypot
    $Phone        = check_input($_POST['phone']);


    //validate name is not empty
    if(empty($Name)){
        $formok 	= false;
        $errors[] = "Please enter your name";
    }

    //validate email address is not empty
    if(empty($Email)){
        $formok 	= false;
        $errors[] = "Please enter an email address";
    } elseif(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
        $formok 	= false;
        $errors[] = "Please enter a valid email address";
    }

    //validate message is not empty
    if(empty($Details)){
        $formok 	= false;
        $errors[] = "Please write me a message";
    }

    //validate honeypot is empty
    if(!empty($Phone)){
        $formok 	= false;
        $errors[] = "Bad Robot!";
    }



    //send email if all is ok
    if($formok){
        $headers 	= "From: $Email" . "\r\n";
        $headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        //email message
        $emailbody = "
            <p>You have received a new contact submission from {$Name}.</p>

            <p>Message:</p>

            <div>{$Details}</div>


            <p>Contact Info:</p>

            <ul>
            <li>Name: {$Name}</li>
            <li>Email: {$Email}</li>
            </ul>

            <br><br><hr>
            <p>This submission was sent on {$date} at {$time} PST</p>";

        mail($EmailTo,$Subject,$emailbody,$headers);

        //Display Success Message
        header("Location: http://www.anitaevensen.com");
    }

    //Display Error Message
    else {
        echo "<div style='width:500px;margin:80px auto 10px;padding:20px;background-color:#FFE6E6;border:3px solid #E58E8E;'>";
        echo "<h2 style='margin: 10px 0 20px;text-align:center;'>The following errors have been found on the form you submitted</h2>";
        echo "<p style='margin: 0 0 0 70px;line-height:1.8;'>";
        echo implode($errors, '<br>');
        echo "</p><h3 style='text-align:center'>Please use the back button on your browser<br>and correct the errors</h3><div>";
    }
}