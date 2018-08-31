<?php
/*
* Template rendering
*/
$authorized = array('41.207.54.89','197.158.78.173','197.158.74.173','::1','127.0.0.1');

if(!in_array($_SERVER['REMOTE_ADDR'],$authorized) && !preg_match('/^(10)(.)(42)(.)([0-9]{1,3})(.)([0-9]{1,3})$/',$_SERVER['REMOTE_ADDR']) && !preg_match('/^(197)(.)(158)(.)([0-9]{1,3})(.)([0-9]{1,3})$/',$_SERVER['REMOTE_ADDR'])) {
    header("HTTP/1.0 404 Not Found");
    exit();
} 