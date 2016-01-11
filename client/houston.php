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
    
    public function getCurrentSatellite() {
        //$stmt = $GLOBALS['mysqli']->prepare("select `last` from whozawhat_currSatellite where id=1");
        $stmt = DB::connection()->prepare("select `last` from whozawhat_currSatellite where id=1");
        if ($stmt !== FALSE){
            $exec = $stmt->execute();
            if ($exec){
                $stmt->store_result();
                $stmt->bind_result($last);
                $stmt->fetch();
                return $last;
            }
            return -1;
        }
        return -1; // Something blew up
    }
    
    private function getSatellite($satId) {
        //$stmt = $GLOBALS['mysqli']->prepare("select `url_path` from whozawhat_satellite where id=?");
        $stmt = DB::connection()->prepare("select `url_path` from whozawhat_satellite where id=?");
        if ($stmt !== FALSE){
            $stmt->bind_param('i', (int)$satId);
            $exec = $stmt->execute();
            if ($exec){
                $stmt->store_result();
                $stmt->bind_result($urlPath);
                $stmt->fetch();
                return $urlPath;
            }
            return -1;
        }
        return -1; // Something blew up
    }
    
    private static function getAllSatellites() {
        //$stmt = $GLOBALS['mysqli']->prepare("select `url_path` from whozawhat_satellite");
        $stmt = DB::connection()->prepare("select `url_path` from whozawhat_satellite");
        if ($stmt !== FALSE){
            $exec = $stmt->execute();
            if ($exec){
                $stmt->store_result();
                $stmt->bind_result($urlPath);
                $stmt->fetch();
                $satArr = array();
                for ($i=0; $i < $stmt->num_rows; $i++){
                    $satArr[$i] = $urlPath;
                    $stmt->fetch();
                }
                return $satArr;
            }
            return array(-1);
        }
        return array(0);
    }
    
    private function updateCurrSatellite($satId) {
        //$stmt = $GLOBALS['mysqli']->prepare("update whozawhat_currSatellite set last = ? where id = 1");
        $stmt = DB::connection()->prepare("update whozawhat_currSatellite set last = ? where id = 1");
        if ($stmt !== FALSE && (int)$satId >= 0 ){
            $stmt->bind_param('i', $satId);
            if ($stmt->execute()){
                return TRUE;
            }
            return FALSE;
        }
        return FALSE;
    }
    
    public function getItem($itemID, $region) {
        $json = file_get_contents($this->satellites[$this->currSatellite]."item.php?id=".$itemID."&region=".$region."&locale=".$this->locale);
        $this->currSatellite = ($this->currSatellite + 1) % $this->satelliteCardinality;
        $this->updateCurrSatellite($this->currSatellite);
        return $json;
    }
    
    public function getCharacter($name, $realm, $region, $keys) {
        $json = file_get_contents($this->satellites[$this->currSatellite]."character.php?name=".$name."&region=".$region."&realm=".$realm."&locale=".$this->locale."&fields=".$keys);
        $this->currSatellite = ($this->currSatellite + 1) % $this->satelliteCardinality;
        $this->updateCurrSatellite($this->currSatellite);
        return $json;
    }
    
    public function getRealm($region) {
        $json = file_get_contents($this->satellites[$this->currSatellite]."realm.php?region=".$region."&locale=".$this->locale);
        $this->currSatellite = ($this->currSatellite + 1) % $this->satelliteCardinality;
        $this->updateCurrSatellite($this->currSatellite);
        return $json;
    }
    
    public function getItemContext($itemID, $region, $context) {
        $json = file_get_contents($this->satellites[$this->currSatellite]."itemContext.php?id=".$itemID."&region=".$region."&locale=".$this->locale."&context=".$context);
        $this->currSatellite = ($this->currSatellite + 1) % $this->satelliteCardinality;
        $this->updateCurrSatellite($this->currSatellite);
        return $json;
    }
    
}

?>