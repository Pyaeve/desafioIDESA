<?php
$t1  = microtime(true);
$url = 'https://desafio.idesa.pyaeveapps.com/v2/public/api/clientes';
//$url ='https://hendyla.com';
$ch = curl_init();


$auth='Authorization:Bearer 1|0owuOKJL27uHipRbo97tdsFcwdhRmcxXfyFO9E3B';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $auth));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // VERIFY SSL CERTIFICATE
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true); // VER

$data = curl_exec($ch);
$info = curl_getinfo($ch);
echo "<pre>";
print_r($info);
echo "</pre>";


curl_close($curl);

$t2 = microtime(true);

$tiempo_ejecucion = $t2 - $t1;
echo 'La página tard&oacute; '.round($tiempo_ejecucion,3).' segundos en ejecutarse';


?>
