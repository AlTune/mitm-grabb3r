<?php
require_once ('includes/functions.php');


$login = new Login();
$template = new Template();


if (!$login->loggedIn()) {
$template->showLogin();
}


$clientId = $_GET["cid"];



$db->bind("client_id", $clientId);
$data["client"] = $db->row("SELECT * FROM clients WHERE client_id = :client_id ");


$db->bind("client_id", $clientId);
$totalItems = $db->single("SELECT COUNT(*) FROM timeline WHERE client_id = :client_id ");

$page = $_GET["page"];
if(empty($page))
$page = 1;

$itemsPerPage = 10;
$pageUrl = "timeline.php?cid=".$clientId;

$totalPages = ceil($totalItems / $itemsPerPage);
$pagePosition = (($page - 1) * $itemsPerPage);


$db->bindMore(array(
    "client_id" => $clientId,
    "page_position" => $pagePosition,
    "items_per_page" => $itemsPerPage
));

$data["timeline"] = $db->query("SELECT * FROM timeline WHERE client_id = :client_id ORDER BY page_load, time ASC LIMIT :page_position, :items_per_page ");


$data["pagination"] = paginate($itemsPerPage, $page, $totalItems, $totalPages, $pageUrl);


//////////////////////////////////////////////////////////

$template->showHeader("Timeline for ".'<span class="label label-danger">'.$data["client"]["ip"].'</span>');

$template->showTimeline($data);

$template->showFooter();

?>