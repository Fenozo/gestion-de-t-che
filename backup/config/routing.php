<?php
$page = 'homepage';
if(isset($_GET['page']))
{
    $page = $_GET['page'];
}

define('PAGE_NAME',$page.'.php');
?>