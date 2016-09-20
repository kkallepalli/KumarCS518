<?php
// $dbhost = 'handson-mysql';
// $dbuser = 'kumar';
// $dbpass = 'kumar';
// $dbname = 'RecipeStack';
$dbhost = 'localhost';
$dbuser = 'admin';
$dbpass = 'M0n@rch$';
$dbname = 'RecipeStack';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error connecting to mysql');
mysql_select_db($dbname);
//echo $conn;

if (!mysql_set_charset('utf8', $conn)) {
    echo "Error: Unable to set the character set.\n";
    exit;
}

function nvl($val, $replace)
{
	if(is_null($val) || $val == '')
		return $replace;
    else
		return $val;
}

function escapeStr($str)
{
	return mysql_real_escape_string(nvl($str, null));
}
?>