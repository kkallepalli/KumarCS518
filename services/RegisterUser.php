<?php
include("../connectDB.php");
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
OR die ('Could not connect to MySQL: '.mysql_error());

$uid=0;
if ($_SERVER ['REQUEST_METHOD'] == "POST") {
	$username=$_POST["username"];
	$password=$_POST["password"];
	$count=0;
	$sql = "SELECT COUNT(*) as count from user where username='".$username."'";
	//$row = mysqli_fetch_array($sql);
	
	//echo $row[0]["count"];
	$result = mysqli_query($conn,$sql);
	
	while ($row = mysqli_fetch_array($result)) {
		$count=$row["count"];
	} 
	
	 if($count==0)
	{
		$sql = "INSERT INTO user(username, password, created_on) VALUES ('".$username."','".$password."','".date("Y-m-d h:i:sa")."')";
		if(mysqli_query($conn,$sql))
		{
			$uid=mysqli_insert_id($conn);
			echo $uid;
		}
		else {
			echo "error-Error in user creation";
		}
	}
	else {
		echo "error-username already exists, try agains ";
	} 
	
	
}
?>