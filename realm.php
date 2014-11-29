<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        header('Content-type: text/html; charset=utf-8');
        include_once 'config.php';
        include_once 'bnet.php';
        if (isset($_GET['region'], $_GET['locale'])){
            echo BattleNet_getRealmStatus($_GET['region'], $_GET['locale']);
        }
        else {
            echo json_encode(array("error"=>-1,'message'=>"Supply required parameters"));
        }
        ?>
    </body>
</html>
