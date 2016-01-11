<?php
    header('Content-type: text/html; charset=utf-8');
    include_once 'config.php';
    include_once 'bnet.php';
    include_once 'bnetHelper.php';
    if (isset($_GET['name'], $_GET['region'], $_GET['realm'], $_GET['locale'], $_GET['fields'])){
        echo BattleNet_getCharacter($_GET['name'], $_GET['realm'], $_GET['region'], $_GET['locale'], $_GET['fields']);
    }
    else {
        echo json_encode(array("error"=>-1,'message'=>"Supply required parameters"));
    }
?>
 