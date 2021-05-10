<?php

declare(strict_types = 1);

$received = false;

if(isset($_POST["email"]) == true && isset($_POST["destination"]) == true
&& isset($_POST["content"]) == true && isset($_POST["subject"]) == true
&& isset($_POST["phone"]) == true) 
{
    $message = "Envoyé par: ".$_POST["email"];
    $message .= "\r\nTéléphone: ".$_POST["phone"];
    $message .= "\r\nObjet: ".$_POST["subject"];
    $message .= "\r\nMessage: \n\n".$_POST["content"];
    $headers = "From: ".$_POST["destination"]."\r\n";
    $headers .= "Reply-To: ".$_POST["email"]."\r\n";
    $headers .= "Content-Type: text/plain; charset=\"utf-8\"; DelSp=\"Yes\"; format=flowed"."\r\n";
    $headers .= "X-Mailer:PHP/".phpversion();
    $received = mail(htmlentities($_POST["destination"]), $_POST["subject"], $message, $headers);
}

if($received == false) 
{
    header("Location: ../html/mail_error.html");
} else {
    header("Location: ../html/mail_ok.html");
}