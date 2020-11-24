<?php
    // My modifications to mailer script from:
    // http://blog.teamtreehouse.com/create-ajax-contact-form
    // Added input sanitizing to prevent injection

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        //receiver
        $mailTo = "yi.yurie@gmail.com, deminawata@gmail.com";

        //subject and message
        $mailSubject = "New message from my blog";
        $mailMessage = "Name: " . $name . " " . "\n" . "Email : ". $email . "\n" . "Subject : ". $subject ."\n" . "Message : ". $message;

        //sender
        $mailFrom = "yi.yurie@gmail.com";

        //return-path
        $returnMail = "yi.yurie@gmail.com";

        //encoding
        mb_internal_encoding("UTF-8");

        $header  = "From: $mailFrom\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: multipart/mixed; boundary=\"__PHP__\"\r\n";
        $header .= "\r\n";

        $body  = "--__PHP__\r\n";
        $body .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
        $body .= "\r\n";
        $body .= $mailMessage . "\r\n";
        $body .= "--__PHP__\r\n";
        
        if (mail($mailTo, $mailSubject, $body, $header,'-f' . $returnMail)) {
            // Set a 200 (okay) response code.
            //http_response_code(200);
            $msg = "Thank you! Your message has been sent.";
            echo $msg;
        } else {
            // Set a 500 (internal server error) response code.
            //http_response_code(500);
            $msg = "Oops! Something went wrong and we couldn't send your message.";
            echo $msg;
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        //http_response_code(403);
        $msg = "There was a problem with your submission. Please try again.";
        echo $msg;
    }

?>
