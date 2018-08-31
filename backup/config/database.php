<?php 
try {
    $database = new PDO('mysql:host=localhost;dbname=manager','root',''); 
} catch(Exception $e){
    print_r($e);
}
