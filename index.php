<?php
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_TIME, "fr_FR");
session_name(md5($_SERVER['HTTP_HOST']));
session_start();
require_once('config/logger.php');
require_once('config/database.php');
require_once('config/crud.php');
require_once('config/routing.php');
require_once('config/session_login.php');
require_once('config/secure.php');
define('CSS_FODLER','assets/css/');
define('JS_FODLER','assets/js/');

if(!empty($_SESSION['id_utilisateur']) && !empty($_SESSION['type_utilisateur'])) {
    include('views/template.php');
} else {
    include('views/login.php');
}
?>