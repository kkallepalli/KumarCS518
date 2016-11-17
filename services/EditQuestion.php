<?php
function EditQuestion($x) {
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
OR die ('Could not connect to MySQL: '.mysql_error());

$sqlcount="SELECT count(*) as count from question Q,user U WHERE U.uid=Q.uid and U.uid!=".$uid;
$rs2 = mysqli_query($conn,$sqlcount);

$sql="SELECT * from question Q WHERE qid=".$x;
$rs4 = mysqli_query($conn,$sql);
	$qtitle = mysql_real_escape_string($qtitle);
	$qcontent = mysql_real_escape_string($qcontent);

	mysql_query(" UPDATE `question` SET
			`qtitle`    = {$qtitle},
			`qcontent`  = '{$qcontent}'
			WHERE `qid` = {$qid}");
}
?>