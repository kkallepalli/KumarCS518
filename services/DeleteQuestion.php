<?php
if (isset($_POST['submit']))
{
	include 'connectDB.php';

	echo alert("Are you sure you wan to delete this question?");
	
	$qtitle=$_POST['qtitle'] ;
	$qid=$POST['qid'];
	$uid= $_POST['uid'] ;
	$aid=$_POST['name'] ;
	
	$tagid = "SELECT tag_id from tags WHERE tag_id =".$tag_id;
	$answer = "SELECT qid from answers WHERE qid= ".$qid;
	$question_tag = "SELECT qid_fk from question_tag WHERE qid_fk =".$qid;

	mysql_query("DELETE FROM tags WHERE tag_id = '$tagid'")
	or die(mysql_error());
	
	mysql_query("DELETE FROM question_tag WHERE qid_fk = '$question_tag'")
	or die(mysql_error());
	
	mysql_query("DELETE FROM answers WHERE qid = '$answer'")
	or die(mysql_error());
	
	mysql_query("DELETE FROM question WHERE qid = '$qid'")
	or die(mysql_error());
}
?>