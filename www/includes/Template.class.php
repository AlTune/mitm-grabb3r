<?php
class Template
{
    
    private $db;
    private $login;
    
    function __construct() {
        $this->userId = Cookie::Get('id');
        $this->db = new db();
        $this->login = new login();
    }
        
    public function showHeader($headerTitle) {
        
        $this->db->bind("id", $this->userId);
        $username = $this->db->single("SELECT username FROM admins WHERE id = :id");

        $clients =  $this->db->query("SELECT * FROM clients ORDER BY ip ASC");

        require_once ('includes/templates/header.php');
    }
    
    public function showFooter() {
        
        require_once ('includes/templates/footer.php');
    }
    public function showLogin() {
        
        require_once ('includes/templates/login.php');
        die();
    }
    public function badLogin() {
        
        require_once ('includes/templates/bad_login.php');
        die();
    }
    function showMessage($message, $title = "Info Message") {
        $this->showHeader($title);
        require_once ('includes/templates/message.php');
        $this->showFooter();
        die();

    }
    public function showIndex($data) {
        
        require_once ('includes/templates/index.php');

    }

    public function showKeylog($data) {
        
        require_once ('includes/templates/keylog.php');

    }

    public function showCookies($data) {
        
        require_once ('includes/templates/cookies.php');

    }
    public function showKeylogs($data) {
        
        require_once ('includes/templates/keylogs.php');

    }

    public function showScreenshots($data) {
        global $config;
        
        require_once ('includes/templates/screenshots.php');

    }
    public function showTimeline($data) {
        
        require_once ('includes/templates/timeline.php');

    }

    public function showCookie($data) {
        
        require_once ('includes/templates/v-cookie.php');

    }
    public function showSettings($data) {
        
        require_once ('includes/templates/settings.php');

    }
}
?>