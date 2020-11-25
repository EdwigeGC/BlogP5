<?php
$errors=[];

if(!array_key_exists('name',$_POST) || $_POST['name'] ==''){
    $errors['name'] = "La case nom/prénom est vide";
}
if(!array_key_exists('email',$_POST) || $_POST['email'] ==''){
    $errors['email'] = "La case E-mail est vide";
}
if(!array_key_exists('message',$_POST) || $_POST['message'] ==''){
    $errors['message'] = "La case message est vide";
}

if(!empty($errors)){
    session_start();
    $_SESSION['error']=$_errors;
    $_SESSION['input'] = $_POST;
    header('Location: /home#contact-anchor');
}

else{
    $_SESSION['success']=1;
    $from = $_POST['email'];
    $name = $_POST['name'];
    $message = $_POST['message'];

mail('edwige.gentymail@gmail.com', $from, $message, $name);

    $titleAction="Confirmation d'enregistrement";
    $actionConfirmation= "/home";
    $textConfirmation="Votre message a bien été envoyé";
    require ('App/views/backend/confirmationTemplate.php');
}