<?php

require_once 'houston_config.php';

class Houston {
    
    public $locale;
    private $currSatellite;
    private $satellites = array();
    private $satelliteCardinality;
            
    function __construct($locale) {
        $this->locale = ( !empty($locale) ? $locale : "en_US");
        $this->currSatellite = Houston::getCurrentSatellite();
        $this->satellites = Houston::getAllSatellites();
        $this->satelliteCardinality = count($this->satellites);
    }
    
    public static function getCurrentSatellite() {
        $stmt = $GLOBALS['mysqli']->prepare("select `last` from whozawhat_currSatellite where id=1");
        if ($stmt !== FALSE){
            $exec = $stmt->execute();
            if ($exec){
                $stmt->store_result();
                $stmt->bind_result($last);
                $stmt->fetch();
                return $last;
            }
            else {
                return -1;
            }
        }
        else {
            return -1; // Something blew up
        }
    }
    
    private static function getSatellite($id) {
        $stmt = $GLOBALS['mysqli']->prepare("select `url_path` from whozawhat_satellite where id=?");
        if ($stmt !== FALSE){
            $stmt->bind_param('i', (int)$id);
            $exec = $stmt->execute();
            if ($exec){
                $stmt->store_result();
                $stmt->bind_result($url_path);
                $stmt->fetch();
                return $url_path;
            }
            else {
                return -1;
            }
        }
        else {
            return -1; // Something blew up
        }
    }
    
    private static function getAllSatellites() {
        $stmt = $GLOBALS['mysqli']->prepare("select `url_path` from whozawhat_satellite");
        if ($stmt !== FALSE){
            $exec = $stmt->execute();
            if ($exec){
                $stmt->store_result();
                $stmt->bind_result($url_path);
                $stmt->fetch();
                $a = array();
                for ($i=0; $i < $stmt->num_rows; $i++){
                    $a[$i] = $url_path;
                    $stmt->fetch();
                }
                return $a;
            }
            else {
                return array(-1);
            }
        }
        else {
            return array(0);
        }
    }
    
    private function updateCurrSatellite($id) {
        $stmt = $GLOBALS['mysqli']->prepare("update whozawhat_currSatellite set last = ? where id = 1");
        if ($stmt !== FALSE && (int)$id > 0 ){
            $stmt->bind_param('i', (int)$id);
            if ($stmt->execute()){
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        else {
            return FALSE;
        }
    }
    
    private function getItem($itemID, $region) {
        $j = file_get_contents($this->satellites[$this->currSatellite-1]."item.php?id=".$itemID."&region=".$region."&locale=".$this->locale);
        $this->currSatellite = ($this->currSatellite + 1) % $this->satelliteCardinality;
        return $j;
    }
    
    public function getCharacter($name, $realm, $region, $keys) {
        $j = file_get_contents($this->satellites[$this->currSatellite-1]."character.php?name=".$name."&region=".$region."&realm=".$realm."&locale=".$this->locale."&fields=".$keys);
        $this->currSatellite = ($this->currSatellite + 1) % $this->satelliteCardinality;
        return $j;
    }
    
    public function getRealm($region) {
        $j = file_get_contents($this->satellites[$this->currSatellite-1]."realm.php?region=".$region."&locale=".$this->locale);
        $this->currSatellite = ($this->currSatellite + 1) % $this->satelliteCardinality;
        return $j;
    }
    
}

?>