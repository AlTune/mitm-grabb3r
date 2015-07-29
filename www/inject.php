<?php
require_once ('includes/functions.php');

?>
if (parent.document.URL == document.location.href){
(function(e) {
    e.setAttribute("src", "<?=$config["path"] ?>tag.php?ip=<?=$_GET["ip"] ?>");
    document.getElementsByTagName("body")[0].appendChild(e);
})
(document.createElement("script"));
void(0);
}