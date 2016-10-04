<?php
include("../connectDB.php");
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
OR die ('Could not connect to MySQL: '.mysql_error());
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