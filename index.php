<?php
session_start ();
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
	float: left;
}

.footer-line p {
	line-height: 58px;
	margin-bottom: 0px;
	font-size: 14px;
	color: #6b6b6b;
}
</style>
<script type="text/javascript">
var uname="";
function createPost()
{
	//alert("uname:"+uname+"title"+$("#postTitle").val());
	var postData = "uname="+ uname+"&title="+$("#postTitle").val()+"&content="+$("#postContent").val();
	alert("post data:"+postData);
    $.ajax({
          type: "post",
          url: "services/CreatePost.php",
          data: postData,
          contentType: "application/x-www-form-urlencoded",
          success: function(responseData, textStatus, jqXHR) {
              alert("data saved  :"+responseData);
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.log(errorThrown);
          }
      });
	$("#myPostModal").modal('hide');
}
function showLogout()
{
	$("#postLink").show();
	$("#loginLink").hide();
	$("#logoutLink").show();
}
</script>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">My Heap Under Flow</a>
			</div>
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">Interesting</a></li>
				<li><a href="#">Featured</a></li>
				<li><a href="#">Hot</a></li>
				<li><a href="#">Week</a></li>
				<li><a href="#">Month</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li id='loginLink'><a data-toggle='modal' data-target='#myModal'>Login</a></li>
				<li id='postLink' style="display: none;"><a data-toggle='modal'
					data-target='#myPostModal'>Post</a></li>
				<li id='logoutLink' style="display: none;"><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</nav>

	<div class="row" style="margin-left: 0px;margin-right: 0px;">
		<div class="col-sm-6 w3-card-2">
<?php
include ("connectDB.php");
function showTopPosts($uid) {
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
	OR die ('Could not connect to MySQL: '.mysql_error());
	$sql1 = "SELECT qid,qtitle,qcontent,U.uid,created_date,U.username FROM question Q,user U WHERE U.uid=Q.uid and U.uid!=".$uid;
	if(!$conn)
	{
		echo "error";
	}
	$rs1 = mysqli_query($conn,$sql1);
	$x = 0;
	while ( $row = mysqli_fetch_assoc ( $rs1 ) ) {
		$postinfo = "<div class='w3-card-2 w3-hover-shadow' data-toggle='collapse' data-target='#collapse" . ($x + 1) . "' style='border-left: 4px solid #009688;'>
		<div class='row post'>
		<div class='col-sm-7'>
			<p class='title'>" . $row ["qtitle"] . "</p> 
		</div>
		<div class='col-sm-2'>
		<a href='#'>Votes <span class='badge'>" . rand ( 0, 20 ) . "</span></a>
		<a href='#'>Answers <span class='badge'>" . rand ( 0, 20 ) . "</span></a>
		</div>
  		<div class='col-sm-3'><p style='word-wrap: break-word;'>Posted by:<br>".$row ["username"]."</p></div>
  		</div>
		<div id='collapse".($x + 1) ."' class='post-footer collapse'><div class='list-group'>";
		$sql2="SELECT A.aid,A.adesc,U.username,A.best_ans FROM answers A,user U WHERE U.uid=A.uid_ans and A.qid=".$row["qid"];
		$rs2 = mysqli_query($conn,$sql2);
		$y = 0;
		while ( $row = mysqli_fetch_assoc ( $rs2 ) ) {
			$postinfo = $postinfo . "<div class='list-group-item'>".$row["adesc"]." Answered by: ".$row["username"]."<a href='#'><img width='24px' height='24px' src='./images/thumb-up-outline.png' ></a><a href='#'><img width='24px' height='24px' src='./images/thumb-down-outline.png' ></a></div>";
		}
		$postinfo = $postinfo . "<div class='list-group-item'><label for='Answer'>Comment:</label><textarea class='form-control' rows='5' id='comment".($x + 1)."' onclick='event.stopPropagation()'></textarea></div>";
		$postinfo = $postinfo . "</div></div></div>";
		echo $postinfo;
		$y = $y + 1;
		$x = $x + 1;
	}
	mysqli_close($conn);
}

if ($_SERVER ['REQUEST_METHOD'] == "POST") {
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
	OR die ('Could not connect to MySQL: '.mysql_error());
	$uname = "";
	$pwd = "";
	if (empty ( $_POST ["email"] )) {
		$nameErr = "username is required";
	} else {
		$uname = escapeStr ( $conn,$_POST ["email"] );
	}
	$pwd = escapeStr ($conn,$_POST ["pwd"] );
	$sql = "SELECT * FROM user WHERE username='" . $_POST ["email"] . "' and password='" . $pwd . "'";
	$uid = 0;
	$rs = mysqli_query ( $conn,$sql );
	while ( $row = mysqli_fetch_assoc ( $rs ) ) {
		$uid = $row ["uid"];
		echo "<script type='text/javascript'>uname=" . $uid . ";showLogout();</script>";
		showTopPosts($uid);
	}

	mysqli_close($conn);
	
	if ($uid == 0) {
		echo "<script type='text/javascript'>alert('Username or password doesnt match');</script>";
	}
}
?>

</div>
		<div class="col-sm-6">
			<div class="row">
				<div class="panel panel-info">
					<div class="panel-heading">My Questions</div>
					<div id="myQuesHolder" class="panel-body" style="height: 60vh;overflow:scroll;">
					<?php
					if ($_SERVER ['REQUEST_METHOD'] == "POST") {
						if ($uid != 0) {
							$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
							OR die ('Could not connect to MySQL: '.mysql_error());
							$sql = "select * from question where uid=".$uid."";
							$rs = mysqli_query ($conn,$sql );
							$x = 0;
							while ( $row = mysqli_fetch_assoc ( $rs ) ) {
								$postinfo = "<div class='w3-card-2 w3-hover-shadow' data-toggle='collapse' data-target='#mycollapse" . ($x + 1) . "' style='border-left: 4px solid #009688;'><div class='row post'>
								<div class='col-sm-8'>
									<p class='title'>" .$row ['qtitle'] ."</p> 
									<p>
						 			<button type='button' class='btn btn-info'>Php</button>
						 		<button type='button' class='btn btn-primary'>Technology</button>
						 			</p>
								</div>
								<div class='col-sm-3'>
								<ul class='w3-ul'>
								<li><a href='#'>Votes <span class='badge'>" . rand ( 0, 20 ) . "</span></a></li>
								<li><a href='#'>Answers <span class='badge'>" . rand ( 0, 20 ) . "</span></a></li>
								<li><a href='#'>Views <span class='badge'>" . rand ( 0, 20 ) . "</span></a></li>
								</ul>
								</div>
						  		<div class='col-sm-1'><p>Posted by: Kumar</p></div>
						  		</div>
								<div id='mycollapse" . ($x + 1) . "' class='post-footer collapse'><div class='list-group'>";
								
								$ans = rand ( 0, 3 );
								
								for($y = 0; $y <= $ans; $y ++) {
									$postinfo = $postinfo . "<a href='#' class='list-group-item'>Your first answer goes here!!</a>";
								}
								
								$postinfo = $postinfo . "</div></div></div>";
								
								echo $postinfo;
								$x = $x + 1;
							}
						}

						mysqli_close($conn);
					}
					?>
					</div>

				</div>
			</div>
			<div class="row">
				<div class="panel panel-info">
					<div class="panel-heading">Recommendations</div>
					<div class="panel-body" style="height: auto;">
						<div></div>
					</div>
				</div>
			</div>

		</div>

		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Login Details</h4>
					</div>
					<div class="modal-body">
						<form
							action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
							method="post">
							<div class="form-group">
								<label for="email">Email address:</label> <input type="text"
									class="form-control" name="email" id="email"><span
									class="error">* <?php echo $emailError;?></span>
							</div>
							<div class="form-group">
								<label for="pwd">Password:</label> <input type="password"
									class="form-control" name="pwd" id="pwd"><span class="error">* <?php echo $pwdError;?></span>
							</div>
							<div class="checkbox">
								<label><input type="checkbox"> Remember me</label>
							</div>
							<button type="submit" class="btn btn-default">Submit</button>
						</form>
					</div>
					<div class="modal-footer"></div>
				</div>
			</div>
		</div>

	</div>

	<div class="modal fade" id="myPostModal" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Post Details</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="postTitle">Title:</label> <input type="text"
							class="form-control" name="postTitle" id="postTitle">
					</div>
					<div class="form-group">
						<label for="postContent">Content:</label>
						<textarea class="form-control" rows="5" id="postContent"
							name="postContent"></textarea>
					</div>
					<button class="btn btn-default" onclick="createPost()">Submit</button>
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>


	<div class="container footer-line">
		<p>Project for CS518 - Developed by Kumar,Surabhi,Satya - 2016</p>
	</div>

</body>
</html>
