<?php
require_once ('includes/functions.php');

$login = new Login();
$template = new Template();

if(!$login->loggedIn() ){
	redirect("index",3);
	$template->showMessage("you have to be logged in be here.","Error");
}

if($login->logout()){
	redirect("index",3);
	$template->showMessage("You have been logged out.","info");
}

?>