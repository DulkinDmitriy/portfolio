<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/Exception.php';
require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/SMTP.php';

try {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host        = 'smtp.gmail.com';
    $mail->SMTPAuth    = true;
    $mail->SMTPSecure  = 'tls';
    $mail->Debugoutput = 'html';
    $mail->SMTPDebug   = 2;
    $mail->Port        = 587;
    $mail->Username    = 'dulkin2010j@gmail.com';
    $mail->Password    = 'jxpynmydszddnxvt';

    $mail->setFrom($_POST['email']);
    $mail->addAddress('dulckin.dim@yandex.ru');
    $mail->Subject = $_POST['theme'] . '. Пользователь: ' . $_POST['name'];
    $mail->Body = $_POST['message'] . "\nEmail пользователя: " . $_POST['email'] . "\nДанное сообщение было отправленно с dulyanich.herokuapp.com";

    $mail->send();
    
    $redirectURL = 'index.php';

    if (headers_sent()) {
        echo ("<script>location.href='$redirectURL'</script>");
    } else {
        header("Location: $redirectURL");
    }
} catch (Throwable $tr) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
