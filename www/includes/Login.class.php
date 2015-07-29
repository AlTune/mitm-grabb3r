<?php

class Login
{
    
    private $cookieId;
    private $cookieHash;
    private $db;
    
    function __construct() {
        $this->cookieId = Cookie::Get('id');
        $this->cookieHash = Cookie::Get('hash');
        $this->db = new db();
    }
    

    private function areCookiesSet() {
        if (!empty($this->cookieId) && !empty($this->cookieHash)) 
        return true;
    }

    public function loggedIn() {
        
        if (!$this->areCookiesSet()) 
        return false;
        
        $this->db->bind("id", $this->cookieId);
        $password = $this->db->single("SELECT password FROM admins WHERE id = :id");
        

        if (empty($password)) return false;
        
        if (sha1($this->cookieId . "MiTMf" . $password) != $this->cookieHash) {
            
            return false;
        }
        
        return true;
    }
    
    public function loginUser($username, $password) {
        
        $this->db->bindMore(array("username" => $username, "password" => md5($password)));
        $data = $this->db->row("SELECT * FROM admins WHERE username = :username AND password = :password ");
        
        if (!$data) 
        return false;
        
        Cookie::Set('id', $data["id"], Cookie::OneDay);
        Cookie::Set('hash', sha1($data["id"] . "MiTMf" . $data["password"]), Cookie::OneDay);
        
        return true;
    }
    

    // logout user
    public function logout() {
        Cookie::Delete('id');
        Cookie::Delete('hash');
        return true;
    }
}
?>