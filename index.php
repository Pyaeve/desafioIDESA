<?php

    include('Database.php');
    include('Rest.php');

    if ($_GET['lote']=='0') {
        
         echo(json_encode(Rest::getLotes()));
    }else{
       
        echo(json_encode(Rest::retriveLotes($_GET['lote'])));
    }

 ?>
