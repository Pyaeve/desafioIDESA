<?php

    include('Database.php');
    include('Rest.php');
    if ($_GET['lote']=='0') {
        header('Content-Type: application/json');
        echo(json_encode(Rest::getLotes()));
    }else{
        header('Content-Type: application/json');
        Rest::retriveLotes($_GET['lote']);
    }

 ?>
