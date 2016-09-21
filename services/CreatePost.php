<?php
require_once '../connectDB.php';
if ($_SERVER ['REQUEST_METHOD'] == "POST") {
	$sql = "SELECT * FROM user WHERE username='kkall002@odu.edu' and password='1234'";
	echo $sql;
	$uid = 0;
	$rs = mysql_query ( $sql );
	while ( $row = mysql_fetch_array ( $rs ) ) {
		$uid = $row ["uid"];
		echo $uid;
	}
}
?>