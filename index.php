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
	position:fixed;
	bottom:0;
}

.footer-line p {
	line-height: 58px;
	margin-bottom: 0px;
	font-size: 14px;
	color: #FFFFFF;
}
</style>
<script type="text/javascript">
var uname="";
function createPost()
{
	//alert("uname:"+uname+"title"+$("#postTitle").val());
	var postData = "uname="+ uname+"&title="+$("#postTitle").val()+"&content="+$("#postContent").val();
    $.ajax({
          type: "post",
          url: "services/CreatePost.php",
          data: postData,
          contentType: "application/x-www-form-urlencoded",
          success: function(responseData, textStatus, jqXHR) {
			   location.reload(); 
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.log(errorThrown);
          }
      });
	$("#myPostModal").modal('hide');
}
function saveAnswer(x,qid)
{
	var desc=$("#comment"+x).val();
	var postData = "uname="+ uname+"&qid="+qid+"&adesc="+desc;
	$.ajax({
          type: "post",
          url: "services/CreateAnswers.php",
          data: postData,
          contentType: "application/x-www-form-urlencoded",
          success: function(responseData, textStatus, jqXHR) {
			  location.reload();   
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.log(jqXHR+":"+errorThrown);
          }
      });
	$("#comment"+x).val("");
}

function showLogout()
{
	$("#postLink").show();
	$("#loginLink").hide();
	$("#logoutLink").show();
	$("#myQuesSection").show();
	$("#aboutUs").hide();
	$("#profileLink").show();
	$('#myQuesSection').css('opacity', '1');
}
function showMyQuestions()
{
	if(uname=="")
	{
		$('#myQuesSection').css('opacity', '0');
	}
	else{
		$('#myQuesSection').css('opacity', '1');
	}
}
function voteQuestion(voteValue)
{
	
}

function showQuesDesc(x)
{
	$('#myDesc'+x).css('opacity', '1');
}
</script>
</head>
<body onload="showMyQuestions()">
	<nav class="navbar navbar-inverse" style="background-color:#4d636f;color:white;">
		<div class="container-fluid">
			<div class="navbar-header">
				<img class="navbar-brand" src='./images/FoodieLogo.png' style="padding: 5px 10px;">
			</div>
			<ul class="nav navbar-nav">
				<li class="active" ><a href="#" style="background-color:#3a4b53;">Top Questions</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li id='profileLink' style="display: none;cursor:hand;color:white;"><a> Welcome,<?php echo $_SESSION["username"]; ?> </a></li>
				<li id='postLink' style="display: none;cursor:hand;"><a data-toggle='modal'data-target='#myPostModal'>Post</a></li>
				<li id='loginLink'><a data-toggle='modal' data-target='#myModal' style='cursor: hand;'>Login</a></li>
				<li id='logoutLink' style="display: none;"><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</nav>
	
	<div id="aboutUs" style="min-height:80vh;padding:10px;">
	<img src='./images/aboutus.png' class="img-responsive">
	
	<div class="jumbotron" style="background-color:#dcdcdc;">
	"One stop to get all your food related questions answered by experts. Post your questions, get answers to your questions, choose the best answer, vote answers up/down, see related questions from other members, share your thoughts by answering the questions."

	<br>
	Our mission is to teach and inspire food lovers across the globe by sharing talent and knowledge.
	</div>
	
	<b>Get Started -  Register Now! </b>
	</div>

	<div class="row" style="margin-left: 0px;margin-right: 0px;min-height:80vh;">
		<div class="col-sm-6 w3-card-2">
<?php
include ("connectDB.php");
function showTopPosts($uid) {
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
	OR die ('Could not connect to MySQL: '.mysql_error());
	$sql1 = "SELECT Q.qid,qtitle,qcontent,U.uid,created_date,U.username,(select count(*) from answers where qid=Q.qid) as answers,(select count(*) from votes_ques where qid=Q.qid) as votes,(select sum(vote_ques) from votes_ques where qid=Q.qid) as value FROM question Q,user U WHERE U.uid=Q.uid and U.uid!=".$uid." order by value desc";
	if(!$conn)
	{
		echo "error";
	}
	$rs1 = mysqli_query($conn,$sql1);
	$x = 0;
	while ( $row = mysqli_fetch_assoc ( $rs1 ) ) {
		$postinfo = "<div class='w3-card-2 w3-hover-shadow' style='border-left: 4px solid #009688;' >
		<div class='row post'>
		<div class='col-sm-7'>
			<p class='title' style='cursor: hand;' data-toggle='collapse' data-target='#collapse" . ($x + 1) . "' >" . $row ["qtitle"] . "</p> 
			<p id='myDesc".($x + 1)."'>".$row["qcontent"]."</p>
		</div>
		<div class='col-sm-2'>
		<a href='#'>Votes <span class='badge'>".$row["votes"]."</span></a>
		Answers <a href='#'><span class='badge'>" .$row["answers"]."</span></a>
		</div>
  		<div class='col-sm-3'><p style='word-wrap: break-word;'>Posted by:<br>".$row ["username"]."</p></div>
  		</div>
		<div id='collapse".($x + 1) ."' class='post-footer collapse'><div class='list-group'><div class='list-group-item row' style='margin:0px;'><a href='javascript:voteQuestion(1)'><img width='24px' height='24px' src='./images/ques-up.png'></a>
			<a href='javascript:voteQuestion(-1)'><img width='24px' height='24px' src='./images/ques-down.png' ></a></div>";
		$sql2="SELECT A.aid,A.adesc,U.username,A.best_ans,(select count(*) from votes_ans where aid=A.aid and vote_ans=1) as upvotes,(select count(*) from votes_ans where aid=A.aid and vote_ans=-1) as downvotes FROM answers A,user U WHERE U.uid=A.uid_ans and A.qid=".$row["qid"];
		$rs2 = mysqli_query($conn,$sql2);
		$y = 0;
		while ( $ansrow = mysqli_fetch_assoc ( $rs2 ) ) {
			$postinfo = $postinfo . "<div class='list-group-item row' style='margin:0px;'><div class='col-sm-6'>".$ansrow["adesc"]."</div><div class='col-sm-2'>Answered by: <b>".$ansrow["username"]."</b></div><a href='#'class='col-sm-2'>".$ansrow["upvotes"]."<img width='24px' height='24px' src='./images/thumb-up-outline.png' ></a><a href='#' class='col-sm-2'>".$ansrow["downvotes"]."<img width='24px' height='24px' src='./images/thumb-down-outline.png' ></a></div>";
		}
		$postinfo = $postinfo . "<div class='list-group-item'><label for='Answer'>Comment:</label><textarea class='form-control' rows='5' id='comment".($x + 1)."' onclick='event.stopPropagation()'></textarea><input type='button' value='Submit' onclick='saveAnswer(".($x+1).",".$row["qid"].")'></div>";
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
		$_SESSION["username"]=$row["username"];
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
				<div id="myQuesSection" style="opacity:0;" class="panel panel-info">
					<div  class="panel-heading">My Questions</div>
					<div id="myQuesHolder" class="panel-body" style="height: 60vh;overflow:scroll;">
					<?php
					if ($_SERVER ['REQUEST_METHOD'] == "POST") {
						if ($uid != 0) {
							$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
							OR die ('Could not connect to MySQL: '.mysql_error());
							$sql = "SELECT Q.qid,qtitle,qcontent,U.uid,created_date,U.username,(select count(*) from answers where qid=Q.qid) as answers,(select count(*) from votes_ques where qid=Q.qid) as votes,(select sum(vote_ques) from votes_ques where qid=Q.qid) as value FROM question Q,user U WHERE U.uid=Q.uid and U.uid=".$uid." order by value desc";
							$rs = mysqli_query ($conn,$sql );
							$x = 0;
							while ( $row = mysqli_fetch_assoc ( $rs ) ) {
								$postinfo = "<div class='w3-card-2 w3-hover-shadow' style='border-left: 4px solid #009688;'><div class='row post'>
								<div class='col-sm-7'>
									<p class='title' style='cursor: hand;' data-toggle='collapse' data-target='#mycollapse" . ($x + 1) . "'>" . $row ["qtitle"] . "</p> 
								</div>
								<div class='col-sm-2'>
								Votes <a href='#'><span class='badge'>".$row["votes"]."</span></a>
								Answers <a href='#'><span class='badge'>" .$row["answers"]."</span></a>
								</div>
						  		<div class='col-sm-3'><p style='word-wrap: break-word;'>Posted by:<br>".$row ["username"]."</p></div>
						  		</div>
								<div id='mycollapse" . ($x + 1) . "' class='post-footer collapse'><div class='list-group'>";
								
								$sql2="SELECT A.aid,A.adesc,U.username,A.best_ans,(select count(*) from votes_ans where aid=A.aid and vote_ans=1) as upvotes,(select count(*) from votes_ans where aid=A.aid and vote_ans=-1) as downvotes FROM answers A,user U WHERE U.uid=A.uid_ans and A.qid=".$row["qid"];
								$rs2 = mysqli_query($conn,$sql2);
								$y = 0;
								while ( $ansrow = mysqli_fetch_assoc ( $rs2 ) ) {
									$postinfo = $postinfo . "<div class='list-group-item row' style='margin:0px;'><div class='col-sm-6'>".$ansrow["adesc"]."</div><div class='col-sm-2'>Answered by: <b>".$ansrow["username"]."</b></div><a href='#'class='col-sm-2'>".$ansrow["upvotes"]."<img width='24px' height='24px' src='./images/thumb-up-outline.png' ></a><a href='#' class='col-sm-2'>".$ansrow["downvotes"]."<img width='24px' height='24px' src='./images/thumb-down-outline.png' ></a></div>";
								}
								$postinfo = $postinfo . "<div class='list-group-item'><label for='Answer'>Comment:</label><textarea class='form-control' rows='5' id='comment".($x + 1)."' onclick='event.stopPropagation()'></textarea><input type='button' value='Submit' onclick='saveAnswer(".($x+1).",".$row["qid"].")'></div>";
								$postinfo = $postinfo . "</div></div></div>";
								echo $postinfo;
								$y = $y + 1;
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
				<div class="panel panel-info" style="display:none;">
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
