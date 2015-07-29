<?php
require_once ('includes/functions.php');

$login = new Login();
$template = new Template();

if ($login->loggedIn()) {
    redirect("index");
    die();
}


if ($_POST) {
    
    $user = $_POST["username"];
    $pass = $_POST["password"];
    


    if ($login->loginUser($user, $pass)) {

        
        //good login- redirect
        redirect("index",3);
        $template->showMessage("You have been logged in and will be redirected to index.", "Logged In");
    } else {

        $template->badLogin();
        
        //bad login, redirect to login page
        redirect("login",3);
        $template->showMessage("We have failed to log you in with provided username and password, you will be redirected to login page again.", "Error");
    }
}

$template->showLogin();


?>