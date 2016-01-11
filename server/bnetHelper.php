<?php

class bnetHelper {
    
    function __construct() {}
    
    public function goodCharacters() {
        return array('!', '&', '\'', '(', ')', ':', '@', '-');
    }
    
    public function badCharacters() {
        return array('%21', '%26', '%27', '%28', '%29', '%3A', '%40', '+');
    }
    
    public function setHeader(){
        return array(
            "Accept:",
            "Date: " . date('D, d M Y H:i:s T'),
            "Content-Type: application/x-www-form-urlencoded; charset=utf-8",
        );
    }
    
    public function getBNetURL($region, $locale, $path) {
        return "https://".strtolower($region).".api.battle.net".$path."?locale=".$locale."&apikey=".API_KEY;
    }
}

?>