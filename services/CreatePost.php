<?php
include("../connectDB.php");
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
OR die ('Could not connect to MySQL: '.mysql_error());
$qid=0;
if ($_SERVER ['REQUEST_METHOD'] == "POST") {
	$title=htmlentities($_POST["title"]);
	$content=$_POST["content"];
	$tags=htmlentities($_POST["tags"]);
	$uid=$_POST["uname"];
	$sql = "INSERT INTO question(qtitle, qcontent, uid, created_date, views) VALUES ('".$title."','".$content."',".$uid.",'".date("Y-m-d h:i:sa ")."',0)";
	
	//echo $sql;
	if(mysqli_query($conn,$sql))
	{
		$qid=mysqli_insert_id($conn);
		$sql_tag="INSERT INTO question_tag values(".$qid.",(select tag_id from tags where tags='".$tags."'))";
		if(mysqli_query($conn,$sql_tag))
		{
			echo $qid;
		}
		else
		{
			echo "error";
		}
		
	}
	else {
		echo "error";
	}
}
?>