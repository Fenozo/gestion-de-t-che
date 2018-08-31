<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Indian/Antananarivo');
require('../config/database.php');
require('../config/crud.php');

$mysql = new MySQLClient('localhost');

$mysql->setDatabase($database);

/*$mysql->setCollection('ticket');
$array = array('assigned_to' => array('3','-1'));
var_dump($mysql->find($array));

exit();*/

function randomText($length = 6) {
    $dico[0] = Array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $dico[1] = Array(1,2,3,4,5,6,7,8,9,0);
    $text = "";
    for($i = 0; $i<$length; $i++) {
        $option = mt_rand(0, 1);
        $case = mt_rand(0,count($dico[$option])-1);
        $text .= $dico[$option][$case];
    }
    return $text;
}

function searchCode($collection,$code) {

    $resultset = $collection->find(Array('code'=>$code));

    if(!empty($resultset)){
        return true;
    } 
    
    return false;
}


if(isset($_SERVER["CONTENT_TYPE"])
&& strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {

    $collection = null;

    $id_utilisateur = null;

    if(isset($_GET['collection']) && isset($_GET['id_utilisateur'])){
        $collection = $_GET['collection'];
        $id_utilisateur = $_GET['id_utilisateur'];
    }

    $mysql->setCollection($collection);

    $request_method = strtoupper($_SERVER['REQUEST_METHOD']);

    $_POST = (array) json_decode(file_get_contents('php://input'));

    $donnees = stdToArray($_POST);

    if(!empty($collection) && !empty($id_utilisateur)) {
        if($request_method=='POST') {
            define("ID_UTILISATEUR",$id_utilisateur);
            traitement_post($mysql,$donnees);
        }
    }
}


function traitement_post($collection,$merge) {
    if(isset($_GET['find'])) {
        if(!empty($merge)) {
            $donnees = $collection->find($merge);
        } else {
            $donnees = $collection->find();
        }

        echo jsonize($donnees);
        exit();
    }

    if(isset($_GET['remove'])) {

        $collection->remove($merge);

        return null;
    }

    if(isset($_GET['update'])) {

        $target = array(
            'code'  =>  $merge['code']
        );

        unset($merge['_id']);

        $collection->update($target,$merge);

        return null;
    }

    if(isset($_GET['update'])) {
        $target = array(
            'code'  =>  $merge['code']
        );

        $merge['updated_on'] = date('Y-m-d h:i:s');
        $collection->update($target,$merge);

        return null;
    }

    if(isset($_GET['save'])) {
        $code = generate_code($collection);

        $donnees = Array(
            'created_on'    =>	date('Y-m-d h:i:s'),
            'user_id'       =>  ID_UTILISATEUR,
            'code'          => $code);

        $donnees = array_merge($donnees,$merge);
        $collection->save($donnees);
    }
}

function generate_code($collection) {
    $code = randomText();

    $donnees = Array();

    $exist = searchCode($collection,$code);

    while($exist==true)
    {
        $code = randomText();
        $exist = searchCode($collection,$code);
    }

    return $code;
}
?>