<?php 
    require($_SERVER["DOCUMENT_ROOT"] . '/header.php');
    
    require($_SERVER["DOCUMENT_ROOT"] . '/footer.php');
?>

<!-- 
$to = $_GET["customerEmailFromForm"];

    $subject = "Thank you for contacting Real-Domain.com";
    $message = "
    <html>
    <head>
    </head>
    <body>
    Thanks, your message was sent and our team will be in touch shortly.
    <img src='http://cdn.com/emails/thank_you.jpg' />
    </body>
    </html>
    ";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $headers .= 'From: <real-email@real-domain.com>' . "\r\n";

    // SEND MAIL
    mail($to,$subject,$message,$headers); -->