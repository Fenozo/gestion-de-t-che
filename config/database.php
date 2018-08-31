<?php 
try {
    $database = new PDO('mysql:host=localhost;dbname=chc','root',''); 
} catch(Exception $e){
    print_r($e);
}
