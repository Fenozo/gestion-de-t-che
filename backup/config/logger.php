<?php
/*
* Script pour le log des visites
*/
$log_name = date('Ymd').'.txt';

$buffer = fopen('log/'.$log_name,'a+');

$log_content = $_SERVER['REMOTE_ADDR']."\t".date('Y-m-d h:i:s')."\t".$_SERVER['HTTP_USER_AGENT']."\t".$_SERVER['REQUEST_URI']."\n";

fputs($buffer,$log_content);

fclose($buffer);