<?php
date_default_timezone_set('Asia/Jakarta');
ini_set("display_errors", true);

$host = "localhost";
//$port = 3306;
$db_username = "root";
$db_password = "";
$db_name = "latihan";

require_once("Database.php");

$db=new Database($host, $port, $db_username, $db_password, $db_name);

function handleException($exception)
{
    echo  $exception->getMessage();
}

set_exception_handler('handleException');
