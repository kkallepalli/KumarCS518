<?php
session_start ();
include ("connectDB.php");
$upicture=null;

if ($_SERVER ['REQUEST_METHOD'] == "POST") {
	//echo "In Post";
	// code to upload image to server and update or insert userpicpath
	if (isset ( $_FILES ['image'] )) {
		$errors = array ();
		$file_name = $_FILES ['image'] ['name'];
		$file_size = $_FILES ['image'] ['size'];
		$file_tmp = $_FILES ['image'] ['tmp_name'];
		$file_type = $_FILES ['image'] ['type'];
		$file_ext = strtolower ( end ( explode ( '.', $_FILES ['image'] ['name'] ) ) );
		
		$new_file_name=$_SESSION["uid"].".".$file_ext;
		//echo $new_file_name;
		
		$expensions = array (
				"jpeg",
				"jpg",
				"png" 
		);
		
		if (in_array ( $file_ext, $expensions ) === false) {
			$errors [] = "extension not allowed, please choose a JPEG or PNG file.";
		}
		
		if ($file_size > 2097152) {
			$errors [] = 'File size must be excately 2 MB';
		}
		
		if (empty ( $errors ) == true) {
			$status=move_uploaded_file ( $file_tmp, "profiles/" . $new_file_name );
			echo "Status of file uplaod:".$status;
			
			$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
			OR die ('Could not connect to MySQL: '.mysql_error());
			
			$sql="update user set upic='".$new_file_name."' where uid=".$_SESSION["uid"];
			
			if (mysqli_query($conn, $sql)) {
				echo "<script>alert('Profile pic changed successfully!!');</script>";
			} else {
				echo  "<script>alert('Error uploading profile pic!!');</script>";
			}
			
		} else {
			print_r ( $errors );
		}
	}
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Stack Exchange</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="http://fonts.googleapis.com/css?family=Montserrat"
	rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Lato"
	rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<script src="js/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet"
	href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="js/bootstrap.min.js"></script>
<style type="text/css">
.title {
	color: grey;
	font-weight: bold;
}

.post {
	padding: 10px;
	margin: 2vh;
}

.post-footer {
	background-color: #009688;
	color: #6b6b6b;
}

.error {
	color: #FF0000;
}

.footer-line {
	margin-top: 40px;
	text-align: center;
	background: #404040;
	width: 100%;
	position: fixed;
	bottom: 0;
}

.footer-line p {
	line-height: 58px;
	margin-bottom: 0px;
	font-size: 14px;
	color: #FFFFFF;
}

.table {
	border-collapse: collapse;
}

@media screen and (min-width: 768px) {
	#userModal .modal-dialog {
		width: 900px;
	}
}

#userModal .modal-dialog {
	width: 75%;
}
</style>
</head>
<body>
	<nav class="navbar navbar-inverse"
		style="background-color: #4d636f; color: white;">
		<div class="container-fluid">
			<div class="navbar-header">
				<img class="navbar-brand" src='./images/FoodieLogo.png'
					style="padding: 5px 10px;">
			</div>
			<ul class="nav navbar-nav">
				<li class="active"><a href="./index.php"
					style="background-color: #3a4b53; margin-right: 2px; margin-left: 2px;">Home
						Page</a></li>
				<li class="active" id='postLink'
					style="display: none; cursor: hand;"><a
					style="background-color: #3a4b53; margin-right: 2px; margin-left: 2px;"
					data-toggle='modal' data-target='#myPostModal'>Post</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li id='profileLink' style="cursor: hand; color: white;">
					<!-- Surbhi: Profile page --> <a data-toggle='modal'
					data-target='#userModal' style='cursor: hand;'> Welcome,<?php echo $_SESSION["username"]; ?> </a>
				</li>
				<li id='logoutLink'><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</nav>

	<div class="row" style="margin: 0px;">
		<div class="col-sm-3">
			<form action="">
      	<?php
						$conn = mysqli_connect ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME ) or die ( 'Could not connect to MySQL: ' . mysql_error () );
						$sql = "SELECT uid, firstname, lastname, address, email, contact, username, password, upic, created_on FROM user where uid='" . $_GET["uid"] . "'";
						if (! $conn) {
							echo "error";
						}
						$userpicpath ="profiles/profile.png";
								
						$rs1 = mysqli_query ( $conn, $sql );
						$x = 0;
						while ( $row = mysqli_fetch_assoc ( $rs1 ) ) {
							if($row["upic"]!=NULL)
								{
									$userpicpath="profiles/".$row["upic"];
								}
							echo "<b>First Name:</b>" . $row ["firstname"] . "<br>";
							echo "<b>Last Name:</b>" . $row ["lastname"] . "<br>";
							echo "<b>Address:</b>" . $row ["address"] . "<br>";
							echo "<b>Contact:</b>" . $row ["contact"] . "<br>";
						}
			?>
      </form>
		</div>
		<div class="col-sm-3">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?uid=".$_SESSION["uid"];?>" method="post"
				enctype="multipart/form-data">
				<div class="form-group">
					<img border='0' width='150' height='160'
						src="<?php echo $userpicpath;?>" />
				</div>
				<div class="form-group">
					<input class="input-group" type="file" name="image"
						id="image" accept="image/jpeg,image/png" />
					<button id="updateBtn" type="submit" class="btn btn-default">Update</button>
				</div>

			</form>
		</div>
	</div>
	
	<div class="row" style="margin:0px;">
	<div class="col-sm-12">
	<?php
		if($_SESSION["uid"]==$_GET["uid"])
		{
			echo "<script>$('#updateBtn').show();$('#image').show();</script>";	
		}
		else 
		{
			echo "<script>$('#updateBtn').hide();$('#image').hide();</script>";	
		}
		
					function showMyPosts()
					{
						$uid=$_GET["uid"];
						if ($uid != 0) {
							$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
							OR die ('Could not connect to MySQL: '.mysql_error());
							
							$sql = "SELECT Q.qid,qtitle,qcontent,U.upic,U.uid,created_date,U.username,(select count(*) from answers where qid=Q.qid) as answers,(select count(*) from votes_ques where qid=Q.qid) as votes,IFNULL((select sum(vote_ques) from votes_ques where qid=Q.qid),0) as value,(select tags from tags where tag_id=(SELECT tag_id_fk FROM `question_tag` WHERE qid_fk=Q.qid)) as tags FROM question Q,user U WHERE U.uid=Q.uid and U.uid=".$uid." order by value desc";
							$rs = mysqli_query ($conn,$sql );
							$x = 0;
							while ( $row = mysqli_fetch_assoc ( $rs ) ) {
								$picurl="profiles/profile.png";
								if($row["upic"]!=NULL)
								{
									$picurl="profiles/".$row["upic"];
								}
								$postinfo = "<div class='w3-card-2 w3-hover-shadow' style='border-left: 4px solid #009688;'><div class='row post'>
								<div class='col-sm-7'>
									<p class='title' style='cursor: hand;' data-toggle='collapse' data-target='#mycollapse" . ($x + 1) . "'>" . $row ["qtitle"] . "</p>
									<p id='qdescription".($x + 1)."'>".$row["qcontent"]."</p>";
						
								if($row["tags"]!=null)
								{
									$postinfo = $postinfo ."<a href='#' style='background-color: #5bc0de;color:#ffffff;padding: 5px;'>".$row["tags"]."</a>";
								}
						
								$postinfo = $postinfo ."</div>
								<div class='col-sm-2'>
								Value <a href='#'><span class='badge'>".$row["value"]."</span></a>
								Answers <a href='#'><span class='badge'>" .$row["answers"]."</span></a></div>
						  		<div class='col-sm-3'><img src='".$picurl."' width='50px' height='50px'  class='img-circle img-responsive'' ><br>".$row ["username"]."</div>
						  		</div>
								<div id='mycollapse" . ($x + 1) . "' class='post-footer collapse'><div class='list-group'>";
						
								$sql2="SELECT A.aid,A.adesc,U.upic,U.username,A.best_ans,(select count(*) from votes_ans where aid=A.aid and vote_ans=1) as upvotes,(select count(*) from votes_ans where aid=A.aid and vote_ans=-1) as downvotes,IFNULL((select sum(vote_ans) from votes_ans where aid=A.aid),0) as value FROM answers A,user U WHERE U.uid=A.uid_ans and A.qid=".$row["qid"]." order by value desc";
								$rs2 = mysqli_query($conn,$sql2);
								$bestansid=0;
								$bestrow="";
								while($arow= mysqli_fetch_assoc ( $rs2 ))
								{
									$picurl="profiles/profile.png";
									if(!empty($ansrow["upic"]))
									{
										$picurl="profiles/".$ansrow["upic"];
									}
									
									if($arow["best_ans"]==1)
									{
										$bestansid=$arow["aid"];
										$bestrow=$arow;
									}
									$bestrow["upic"]=$picurl;
								}
								mysqli_data_seek($rs2,0);
								$y = 0;
								if($bestansid>0)
								{
									$postinfo = $postinfo . "<div class='list-group-item row' style='margin:0px;'><div class='col-sm-6'>".$bestrow["adesc"]."</div><div class='col-sm-2'><img src='".$bestrow["upic"]."' width='50px' height='50px'  class='img-circle img-responsive'' ><b>".$bestrow["username"]."</b></div><a href='#'class='col-sm-1'>".$bestrow["upvotes"]."<img width='24px' height='24px' src='./images/thumb-up-outline.png' ></a><a href='#' class='col-sm-1'>".$bestrow["downvotes"]."<img width='24px' height='24px' src='./images/thumb-down-outline.png' ></a><div class='col-sm-2'><img  class='img-responsive' width='24px' height='24px' src='./images/bestans.png' ></div></div>";
									$y=$y+1;
								}
								while ( $ansrow = mysqli_fetch_assoc ( $rs2 ) ) {
									if($bestansid!=$ansrow["aid"])
									{
										$picurl="profiles/profile.png";
										if(!empty($ansrow["upic"]))
										{
											$picurl="profiles/".$ansrow["upic"];
										}
										
										if($bestansid>0)
										{
											$postinfo = $postinfo . "<div class='list-group-item row' style='margin:0px;'><div class='col-sm-6'>".$ansrow["adesc"]."</div><div class='col-sm-2'><img src='".$picurl."' width='50px' height='50px'  class='img-circle img-responsive'' > <b>".$ansrow["username"]."</b></div><a href='#' class='col-sm-1'>".$ansrow["upvotes"]."<img width='24px' height='24px' src='./images/thumb-up-outline.png' ></a><a href='#' class='col-sm-1'>".$ansrow["downvotes"]."<img width='24px' height='24px' src='./images/thumb-down-outline.png' ></a></div>";
										}
										else
										{
											$postinfo = $postinfo . "<div class='list-group-item row' style='margin:0px;'><div class='col-sm-6'>".$ansrow["adesc"]."</div><div class='col-sm-2'><img src='".$picurl."' width='50px' height='50px'  class='img-circle img-responsive'' ><b>".$ansrow["username"]."</b></div><a href='#'class='col-sm-1'>".$ansrow["upvotes"]."<img width='24px' height='24px' src='./images/thumb-up-outline.png' ></a><a href='#' class='col-sm-1'>".$ansrow["downvotes"]."<img width='24px' height='24px' src='./images/thumb-down-outline.png' ></a><div class='col-sm-2'><button onclick='submitBestAns(".$ansrow["aid"].")'>Mark</button></div></div>";
										}
									}
								}
								//$postinfo = $postinfo . "<div class='list-group-item'><label for='Answer'>Comment:</label><textarea class='form-control' rows='5' id='mycomment".($x + 1)."' onclick='event.stopPropagation()'></textarea><input type='button' value='Submit' onclick='saveAnswer(2,".($x+1).",".$row["qid"].")'></div>";
								$postinfo = $postinfo . "</div></div></div>";
								echo $postinfo;
								$y = $y + 1;
								$x = $x + 1;
							}
						}
					}
						showMyPosts();
					?>
	</div>
	</div>
	
	
	<div class="container footer-line">
		<p>Project for CS518 - Developed by Kumar,Surabhi,Satya - 2016</p>
	</div>

</body>
</html>
