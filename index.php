<?php 
session_start();
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
	color: white;
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
    color: #fff;
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
			<li id='postLink' style="display: none;"><a data-toggle='modal' data-target='#myPostModal'>Post</a></li>
			<li id='logoutLink' style="display: none;"><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</nav>

	<div class="row" style="margin-left: 0px;">
		<div class="col-sm-6 w3-card-2">
<?php
require_once 'connectDB.php';
function showTopPosts($uid) {
	$sql="select * from Question where uid=".$uid."";
	$rs = mysql_query ( $sql );
	$x = 0;
	while ( $row = mysql_fetch_array ( $rs ) ) {
		$postinfo = "<div class='w3-card-2 w3-hover-shadow' data-toggle='collapse' data-target='#collapse" . ($x + 1) . "' style='border-left: 4px solid #009688;'><div class='row post'>
		<div class='col-sm-8'>
			<p class='title'>".$row['QTitle']."</p> 
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
		<div id='collapse" . ($x + 1) . "' class='post-footer collapse'><div class='list-group'>";
		
		$ans = rand ( 0, 3 );
		
		for($y = 0; $y <= $ans; $y ++) {
			$postinfo = $postinfo . "<a href='#' class='list-group-item'>Your first answer goes here!!</a>";
		}
		
		$postinfo = $postinfo . "</div></div></div>";
		
		echo $postinfo;
		$x= $x+1;
	}
}

if ($_SERVER ['REQUEST_METHOD'] == "POST") {
	$uname = "";
	$pwd="";
	if (empty ( $_POST ["email"] )) {
		$nameErr = "username is required";
	} else {
		$uname = escapeStr($_POST ["email"]) ;
	}
	$pwd= escapeStr($_POST ["pwd"] ) ;
	
	$sql ="SELECT * FROM user WHERE username='" . $_POST ["email"] . "' and password='" . $pwd. "'";
	$uid = 0;
	$rs = mysql_query ( $sql ) or die("sql error".mysql_error());
	while ( $row = mysql_fetch_array ( $rs ) ) {
		$uid = $row ["uid"];
		echo "<script type='text/javascript'>uname=".$uid.";showLogout();</script>";
		showTopPosts ($uid);
	}

	if ($uid == 0) {
		echo "<script type='text/javascript'>alert('Username or password doesnt match');</script>";
	}
}
?>

</div>
		<div class="col-sm-6">
			<div class="row">
				<div class="panel panel-info">
					<div class="panel-heading">Top Questions</div>
					<div class="panel-body" style="height: 40vh;"></div>

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
						 <textarea class="form-control" rows="5" id="postContent" name="postContent"></textarea>
					</div>
					<button class="btn btn-default" onclick="createPost()">Submit</button>
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>


	<div class="container footer-line"><p>Project for CS518 - Developed by Kumar,Surabhi,Satya - 2016</p></div>

</body>
</html>
