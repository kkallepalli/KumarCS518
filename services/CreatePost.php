<?php
require_once '../connectDB.php';
$qid=0;
if ($_SERVER ['REQUEST_METHOD'] == "POST") {
	$title=$_POST["title"];
	$content=$_POST["content"];
	$uid=$_POST["uname"];
	$sql = "INSERT INTO Question(QTitle, QContent, uid, created_date, views) VALUES ('".$title."','".$content."',".$uid.",'".date("Y-m-d h:i:sa ")."',0)";
	echo $sql;
	if(mysqli_query($conn,$sql))
	{
		$qid=mysqli_insert_id($conn);
		echo $qid;
	}
	else {
		echo "error";
	}
}
?>