<?php
  
    $fname = $_POST["name"];
    $lname = $_POST["lname"];
    $phone = $_POST["phone"];
    $organization = $_POST["Organization"];    
    $emailFrom = $_POST["email"];
    $message = $_POST["message"];
    
    $emailTo = "kachy211@gmail.com";
    $headers = "From: ". $emailFrom;
    $txt = "You have received an email from the contact form on the FEMDEV website. \n\n First Name: ".$fname. " \n Last Name: "
    .$lname." \nPhone Number: ".$phone."\n Message: ".$message;


    $retval = mail($emailTo, "Contact Form Message: ".$fname." ".$lname, $txt, $headers);
    
    if($retval == true){
        header('Location: thank-you.html');
    }
    else{
        echo "Message could not be sent...";
    }

?>
