<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$timezone = "Asia/Kolkata";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);

require_once 'db.class.php';
require_once 'funcs.general.php';

session_start();

define("SITE_TITLE",'Motorbuddy');

if( $_SERVER['HTTP_HOST'] == "dev.motorbuddy.com" ){
	define("ROOT_DIR",'/dev.motorbuddy.com');

	define("SITE_URL",'http://dev.motorbuddy.com');

	define("DB_HOST",'localhost');

	define("DB_USER",'root');

	define("DB_PASSWD",'root');

	define("DB_NAME",'db_motorbuddy');

	define("USE_PCONNECT",'false');

} else {
	define("ROOT_DIR",'/motorbuddy');

	define("SITE_URL",'http://www.vasaibirds.com/motorbuddy');

	define("DB_HOST",'localhost');

	define("DB_USER",'root');

	define("DB_PASSWD",'secret');

	define("DB_NAME",'corephp_adminlte');

	define("USE_PCONNECT",'false');
}

define("X_App_Key",'95d7e28234ce4318ac6a732a38bf659f1f431e865ed7c789d35854b9b2468321');

define("GUEST_TOKEN",'95d7e28234ce4318ac6a732a38bf659f1f431e865ed7c789d35854b9b246873b');

define("ACCESS_TOKEN_EXPIRY_LIMIT",'4');


?>
