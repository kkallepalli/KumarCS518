<?php
include("../connectDB.php");
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
OR die ('Could not connect to MySQL: '.mysql_error());
$aid=0;
if ($_SERVER ['REQUEST_METHOD'] == "POST") {
	$adesc = test_input($_POST["adesc"]);
	$qid = $_POST["qid"];
	$uid = $_POST["uname"];
	
	$sql = "INSERT INTO Answers(adesc, qid, uid_ans, answered_date) VALUES ('".$adesc."',".$qid.",".$uid.",'".date("Y-m-d h:i:sa ")."')";
	echo $sql;
	if(mysqli_query($conn,$sql))
	{
		$aid=mysqli_insert_id($conn);
		echo $aid;
	}
	else {
		echo "error";
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>