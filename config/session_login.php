<?php
/*
* 3 attemps only is need to be optimized
*/
if(isset($_GET['logout']))
{
    
    /*
    * Historique des logins utilisateurs
    */
    //user_historic($_SESSION['id_utilisateur'],0);

    $_SESSION['id_utilisateur'] = null;
    $_SESSION['nom_utilisateur'] = null;
    $_SESSION['pseudo_utilisateur'] = null;
    $_SESSION['type_utilisateur'] = null;

    header('location:index.php');
}

if(isset($_POST['login']))
{
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

    $utilisateur = user_check($pseudo,$password);


    if(!empty($utilisateur)) {
        $_SESSION['id_utilisateur'] = $utilisateur['id'];
        $_SESSION['nom_utilisateur'] = $utilisateur['nom'];
        $_SESSION['prenom_utilisateur'] = $utilisateur['prenom'];
        $_SESSION['type_utilisateur'] = $utilisateur['type'];
        $_SESSION['email_utilisateur'] = $utilisateur['email'];
        
        /*
        * Historique des logins utilisateurs
        */
        //user_historic($utilisateur['id'],1);
    }


    header('location:index.php');
}

function user_check($pseudo,$password) 
{
    global $database;
    
    $mysql = new MySQLClient();

    $mysql->setDatabase($database);  

    $mysql->setCollection('utilisateur');

    $critere = Array(
        'pseudo' => $pseudo,
        'password' => md5($password)
    );

    $rows = $mysql->find($critere);

    $utilisateur = array();
    foreach($rows as $row) {
        $utilisateur [] = $row;
    }

    if(count($utilisateur)==1){
        return $utilisateur[0];
    }

    return null;
}

function user_historic($id_utilisateur,$type)
{
    global $database;
    
    $mysql = new MySQLClient();

    $mysql->setDatabase($database);  

    $mysql->setCollection('historique_login');

    $critere = Array(
        'date_ajout'        => date('Y-m-d h:i:s'),
        'id_utilisateur'    => $id_utilisateur,
        'ip_address'        => $_SERVER['REMOTE_ADDR'],
        'type'              => $type
    );

     $mysql->save($critere);
}


function check_user($pseudo,$password) 
{
    $mongo = new MongoClient();

    $database = $mongo->manager;

    $collection = $database->utilisateur;

    $critere = Array(
            'pseudo' => $pseudo,
            'password' => md5($password)
        );

    $rows = $collection->find($critere);


    $rows = iterator_to_array($rows);

    $utilisateur = array();
    foreach($rows as $row) {
        $utilisateur [] = $row;
    }

    if(count($utilisateur)==1){
        return $utilisateur[0];
    }

    return null;
}