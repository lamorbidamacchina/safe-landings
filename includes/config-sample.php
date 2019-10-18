<?php // configuration file

ini_set('session.gc_maxlifetime', 7200);
session_set_cookie_params(7200);
session_start();
date_default_timezone_set('Europe/Rome');

$_POST = array_map('strip_tags', $_POST);
$_GET = array_map('strip_tags', $_GET);

error_reporting(E_ALL & ~E_STRICT & ~E_DEPRECATED & ~E_NOTICE & ~E_WARNING);
//error_reporting(E_ALL);
@ini_set('display_errors', 'On');
@ini_set('short_open_tag', false);

$hostName = $_SERVER["HTTP_HOST"];
$completeUrl = $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];

// INSERT YOUR DATABASE CONNECTION DATA HERE
$DB_HOST = "";
$DB_NAME = "";
$DB_USR = "";
$DB_PWD = "";

define('SITE_ID',"Safe Landing");
define('SITE_ROOT',dirname(dirname(__FILE__)));
define('WWW_URL',"http://".$hostName);
define('HOST',$hostName);
define('CURR_YEAR',"2019");
define('OWNER',"");
define('LANGUAGES',"it,en");
define('MAINLANGUAGE',"_it");
define('DEBUGLEVEL',3);
define('DEBUGSCREEN',3);


try {
    $db = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8",$DB_USR,$DB_PWD);
} catch (PDOException $e) {
    die("no connection");
}
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->exec("SET NAMES 'utf8';");
$db->exec("SET CHARACTER SET utf8");




// generate values using /generate_key.php script
$private_key = ""; // INSERT PRIVATE KEY HERE
$index_key = ""; // INSERT BLIND INDEX KEY HERE

if ($private_key == "" || $index_key =="") {
	header("location: generate_key.php");
	exit();
}

function __autoload( $class )
{
	$load = SITE_ROOT.'/classes/'.$class.'.php';
	if( file_exists( $load ) )
	{
		include_once( $load );
	}
	else
	{
		die( "Can't find a file for class: $class - $load \n" );
	}
}

?>
