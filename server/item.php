<?php
    header('Content-type: text/html; charset=utf-8');
    include_once 'config.php';
    include_once 'bnet.php';
    include_once 'bnetHelper.php';
    if (isset($_GET['id'], $_GET['region'], $_GET['locale'])){
        echo BattleNet_getRawItem($_GET['id'], $_GET['region'], $_GET['locale']);
    }
    else {
        echo json_encode(array("error"=>-1,'message'=>"Supply required parameters"));
    }
?>