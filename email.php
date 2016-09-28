
<?php
require_once('PHPMailer/class.phpmailer.php');

$bodytext = "o the other side";
$email = new PHPMailer();
$email->From      = 'hacker@hack.com';
$email->FromName  = 'hacker';
$email->Subject   = 'attachment';
$email->Body      = $bodytext;
$email->AddAddress( 'sagun_90@hotmail.com' );

//$file_to_attach = '/upload/file.txt';

if (!$email->AddAttachment("upload/file.txt" )){
    echo "File is not attached";
}
else {

if(!$email->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
}


?>