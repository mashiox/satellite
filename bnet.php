<?php

function BattleNet_getCharacter($name, $realm, $region, $locale, $fields) {
    if (is_array($fields)){
        $fields = implode(',', $fields);
    }
    $badCharacters = array('%21', '%26', '%27', '%28', '%29', '%3A', '%40', '+', '%20');
    $goodCharacters = array('!', '&', '\'', '(', ')', ':', '@', '-', ' ');
    $realm = str_replace($badCharacters, $goodCharacters, $realm);
    
    $path = "/wow/character/".$realm."/".$name."?fields=".$fields."&locale=".$locale."&apikey=".API_KEY;
    $url = "https://".strtolower($region).".api.battle.net".$path;
    $req = date('D, d M Y H:i:s T');
    
    $header = array(
        "Accept:",
        "Date: " .$req,
        "Content-Type: application/x-www-form-urlencoded; charset=utf-8",
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, 2);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
    $e = curl_exec($ch);
    if (curl_errno($ch) === 0){
        return $e;
    }
    else {
        trigger_error("cURL could not connect to battle.net api. Curl error number:".curl_errno($ch));
        return FALSE;
    }
} 

function BattleNet_getRealmStatus($region, $locale) {
    if (empty($region)){
        return FALSE;
    }
    else {
        $badCharacters = array(' ');
        $goodCharacters = array('%20');
        $path = "/wow/realm/status";
        $url = "https://".strtolower($region).".api.battle.net".$path."?locale=".$locale."&apikey=".API_KEY;
        $req = date('D, d M Y H:i:s T');
        $header = array(
            "Accept:",
            "Date: ".$req,
            "Content-Type: application/x-www-form-urlencoded; charset=utf-8",
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $e = curl_exec($ch);
        if (curl_errno($ch) === 0){
            return $e;
        }
        else {
            trigger_error("cURL could not connect to battle.net api. Curl error number:".curl_errno($ch));
            return FALSE;
        }
    }
}

function BattleNet_getRawItem($itemID, $region, $locale) {
    if (empty($itemID) || !is_numeric($itemID)){
        return FALSE;
    }
    else {
        $badCharacters = array('%21', '%26', '%27', '%28', '%29', '%3A', '%40', '+');
        $goodCharacters = array('!', '&', '\'', '(', ')', ':', '@', '-');
        $signPath = "/wow/item/".urlencode($itemID);
        $signPath = str_replace($badCharacters, $goodCharacters, $signPath);

        $path = "/wow/item/".$itemID;
        $url = "https://".strtolower($region).".api.battle.net".$path."?locale=".$locale."&apikey=".API_KEY;
        $req = date('D, d M Y H:i:s T');

        $header = array(
            "Accept:",
            "Date: " . $req,
            "Content-Type: application/x-www-form-urlencoded; charset=utf-8",
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        $e = curl_exec($ch);
        if (curl_errno($ch) === 0){
            return $e;
        }
        else {
            trigger_error("cURL could not connect to Battle.net Item api. Curl error number:".curl_errno($ch));
            return FALSE;
        }
    }
}

function BattleNet_getRawItemWithContext($itemID, $region, $locale, $context) {
    if (empty($itemID) || !is_numeric($itemID)){
        return FALSE;
    }
    else {
        $badCharacters = array('%21', '%26', '%27', '%28', '%29', '%3A', '%40', '+');
        $goodCharacters = array('!', '&', '\'', '(', ')', ':', '@', '-');
        $signPath = "/wow/item/".urlencode($itemID)."/".$context;
        $signPath = str_replace($badCharacters, $goodCharacters, $signPath);

        $path = "/wow/item/".$itemID."/".$context;
        $url = "https://".strtolower($region).".api.battle.net".$path."?locale=".$locale."&apikey=".API_KEY;
        $req = date('D, d M Y H:i:s T');

        $header = array(
            "Accept:",
            "Date: " . $req,
            "Content-Type: application/x-www-form-urlencoded; charset=utf-8",
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        $e = curl_exec($ch);
        if (curl_errno($ch) === 0){
            return $e;
        }
        else {
            trigger_error("cURL could not connect to Battle.net Item api. Curl error number:".curl_errno($ch));
            return FALSE;
        }
    }
}

?>
