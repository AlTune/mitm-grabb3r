<?php
require_once ('includes/functions.php');


$login = new Login();
$template = new Template();

if (!$login->loggedIn()) {
$template->showLogin();
}

$sid = $_GET["id"];

$db->bind("screencap_id", $sid);

$screenshotData = $db->row("SELECT cl.client_id, cl.ip, sc.client_id, sc.screencap_id, sc.image_id, sc.page_load, sc.website, sc.time 
	FROM clients AS cl JOIN screen_capture AS sc ON cl.client_id = sc.client_id WHERE sc.screencap_id = :screencap_id ORDER BY sc.time DESC ");

$template->showHeader("Screenshots");

$template->showScreenshots($screenshotData);

$template->showFooter();

?>