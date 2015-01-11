<?php
    header('Content-type: text/html; charset=utf-8');
    include_once 'config.php';
    include_once 'bnet.php';
    if (isset($_GET['id'], $_GET['region'], $_GET['locale'], $_GET['context'])){
        echo BattleNet_getRawItemWithContext((int)$_GET['id'], $_GET['region'], $_GET['locale'], $_GET['context']);
    }
    else {
        echo json_encode(array("error"=>-1,'message'=>"Supply required parameters"));
    }
?>