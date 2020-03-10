<?php
    $name = $_POST['name'];
    $theme = $_POST['theme'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    mail(
        'dulckin.dim@yandex.ru', 
        "$theme", 
        "$message", 
        "From: {$email}"
    );
?>