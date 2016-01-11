<?php

function BattleNet_getCharacter($name, $realm, $region, $locale, $fields) {
    if (is_array($fields)){
        $fields = implode(',', $fields);
    }
    $bnHelper = new bnetHelper();
    $realm = str_replace($bnHelper->goodCharacters(), $bnHelper->badCharacters(), $realm);
    
    $path = "/wow/character/".$realm."/".$name."?fields=".$fields."&locale=".$locale."&apikey=".API_KEY;
    $url = "https://".strtolower($region).".api.battle.net".$path;
    
    $header = $bnHelper->setHeader();
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($curl, CURLOPT_TIMEOUT, 20);
    curl_setopt($curl, CURLOPT_FRESH_CONNECT, 2);
    curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
    $execStatus = curl_exec($curl);
    if (curl_errno($curl) === 0){
        return $execStatus;
    }
    trigger_error("cURL could not connect to battle.net api. Curl error number:".curl_errno($curl));
    return FALSE;
} 

function BattleNet_getRealmStatus($region, $locale) {
    if (empty($region)){
        return FALSE;
    }
    $bnHelper = new bnetHelper();
    $path = "/wow/realm/status";
    $url = $bnHelper->getBNetURL($region, $locale, $path);
    $header = $bnHelper->setHeader();
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($curl, CURLOPT_TIMEOUT, 20);
    curl_setopt($curl, CURLOPT_FRESH_CONNECT, 2);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    $execStatus = curl_exec($curl);
    if (curl_errno($curl) === 0){
        return $execStatus;
    }
    trigger_error("cURL could not connect to battle.net api. Curl error number:".curl_errno($curl));
    return FALSE;
}

function BattleNet_getRawItem($itemID, $region, $locale) {
    if ( !trim($itemID) || !is_numeric($itemID)){
        return FALSE;
    }
    $bnHelper = new bnetHelper();

    $path = "/wow/item/".$itemID;
    $url = $bnHelper->getBNetURL($region, $locale, $path);
    
    $header = $bnHelper->setHeader();
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($curl, CURLOPT_TIMEOUT, 20);
    curl_setopt($curl, CURLOPT_FRESH_CONNECT, 2);
    curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
    $execStatus = curl_exec($curl);
    if (curl_errno($curl) === 0){
        return $execStatus;
    }
    trigger_error("cURL could not connect to Battle.net Item api. Curl error number:".curl_errno($curl));
    return FALSE;
}

function BattleNet_getRawItemWithContext($itemID, $region, $locale, $context) {
    if ( !trim($itemID) || !is_numeric($itemID)){
        return FALSE;
    }
    $bnHelper = new bnetHelper();

    $path = "/wow/item/".$itemID."/".$context;
    $url = $bnHelper->getBNetURL($region, $locale, $path);
    
    $header = $bnHelper->setHeader();
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($curl, CURLOPT_TIMEOUT, 20);
    curl_setopt($curl, CURLOPT_FRESH_CONNECT, 2);
    curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
    $execStatus = curl_exec($curl);
    if (curl_errno($curl) === 0){
        return $execStatus;
    }
    trigger_error("cURL could not connect to Battle.net Item api. Curl error number:".curl_errno($curl));
    return FALSE;
}

?>
