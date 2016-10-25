<?php
session_start ();
include ("connectDB.php");
$_SESSION["username"]=$_POST["email"];
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
	position: relative;
	bottom: 0;
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
 var recQid='<?php echo $_SESSION["recQid"]; ?>';

/* Satya: Code for user registration: */
function regUser()
{
	if ($("#newUserId").val() == "" || $("#newUserPw").val() == "") {
		alert ("Username & Password is mandatory");
	} else {
				
	var postData = "&username="+$("#newUserId").val()+"&password="+$("#newUserPw").val();
    $.ajax({
          type: "post",
          url: "services/RegisterUser.php",
          data: postData,
          contentType: "application/x-www-form-urlencoded",
          success: function(responseData, textStatus, jqXHR) {
              if(responseData.split("-")[0]=="error")
              {
            	  alert(responseData.split("-")[1]);
                }
              else
              {
               alert("Registration successful, please login using the link above")
			   location.reload(); 
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.log(errorThrown);
          }
      });
	$("#regModal").modal('hide');
	}
}


function createPost()
{
	if($("#postTitle").val()=='' || $("#postTitle").val()==null || $("#postContent").val()=="" || $("#postContent").val()==null )
	{
		alert("Post Title & content cannot be empty : "+$("#tags").val());
		}
	else
	{
			var postData = "uname="+ uname+"&title="+$("#postTitle").val()+"&content="+$("#postContent").val()+"&tags="+$("#tags").val();
		    $.ajax({
		          type: "post",
		          url: "services/CreatePost.php",
		          data: postData,
		          contentType: "application/x-www-form-urlencoded",
		          success: function(responseData, textStatus, jqXHR) {
		              if(responseData=="error")
		              {
		            	  alert("uname:"+uname+"title"+$("#postTitle").val());
		                 }
		              else
		              {
					   location.reload(); 
		              }
		          },
		          error: function(jqXHR, textStatus, errorThrown) {
		              console.log(errorThrown);
		          }
		      });
			$("#myPostModal").modal('hide');
	}
}
function saveAnswer(type,x,qid)
{
	var desc="";
	if(type==1)
	{
		desc=$("#comment"+x).val();
		}else
		{
			desc=$("#mycomment"+x).val();
		}
	 
	var postData = "uname="+ uname+"&qid="+qid+"&adesc="+desc;
	$.ajax({
          type: "post",
          url: "services/CreateAnswers.php",
          data: postData,
          contentType: "application/x-www-form-urlencoded",
          success: function(responseData, textStatus, jqXHR) {
			recQid=qid;
			  location.reload();   
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.log(jqXHR+":"+errorThrown);
          }
      });
	if(type==1)
	{
		$("#comment"+x).val("");
		}else
		{
			$("#mycomment"+x).val("");
		}
	
}

function showLogout()
{
	$("#postLink").show();
	$("#topbar").show();
	$("#loginLink").hide();
	$("#logoutLink").show();
	$("#myQuesSection").show();
	$("#aboutUs").hide();
	$("#profileLink").show();
	$("#registerLink").hide();
	$('#myQuesSection').css('opacity', '1');
	$('#recommendationPanel').show();

}
function showMyQuestions()
{
	if(uname=="")
	{
		$('#myQuesSection').css('opacity', '0');
		$('#recommendationPanel').hide();
	}
	else{
		$('#myQuesSection').css('opacity', '1');
		loadRecommendations(uname,1,recQid);
	}
}
function submitBestAns(aid)
{
	var postData = "aid="+ aid+"&bestans=1";
	$.ajax({
          type: "post",
          url: "services/BestAns.php",
          data: postData,
          contentType: "application/x-www-form-urlencoded",
          success: function(responseData, textStatus, jqXHR) {
			  location.reload();   
			  alert("Best answer for your question is marked!!");
          },
          error: function(jqXHR, textStatus, errorThrown) {
              alert("Error setting best answer!! Try again");
              console.log(jqXHR+":"+errorThrown);
          }
      });
}
function voteQuestion(voteValue,qid)
{
	// calling Set Vote Question service
	var postData = "vote_ques="+ voteValue+"&qid="+qid+"&vote_ques_uid="+uname;
	$.ajax({
          type: "post",
          url: "services/SetVotesQues.php",
          data: postData,
          contentType: "application/x-www-form-urlencoded",
          success: function(responseData, textStatus, jqXHR) {
              if(responseData!="error")
              {
		            	  if(parseInt(voteValue)==1)
		          		{
		          			$('#qVoteUp'+qid).text(parseInt($('#qVoteUp'+qid).text())+1);
		          		}
		          		else{
		          			$('#qVoteDown'+qid).text(parseInt($('#qVoteDown'+qid).text())+1);
		          		}
                }
              else
              {
					alert("You have already voted for this question");
                  }
        	
          },
          error: function(jqXHR, textStatus, errorThrown) {
              alert("Error setting best answer!! Try again");
              console.log(jqXHR+":"+errorThrown);
          }
      });
}

function voteAnswer(voteValue,aid,qid)
{
	var postData = "vote="+ voteValue+"&aid="+aid+"&uname="+uname+"&qid="+qid;
	$.ajax({
          type: "post",
          url: "services/SetVoteAns.php",
          data: postData,
          contentType: "application/x-www-form-urlencoded",
          success: function(responseData, textStatus, jqXHR) {
              if(responseData!="error")
              {
            	  if(parseInt(voteValue)==1)
            		{
            			$('#qAnsUp'+aid).text(parseInt($('#qAnsUp'+aid).text())+1);
            		}
            		else{
            			$('#qAnsDown'+aid).text(parseInt($('#qAnsDown'+aid).text())+1);
            		}
                }
              else
              {
					alert("You have already voted for this answer");
                  }
        	
          },
          error: function(jqXHR, textStatus, errorThrown) {
              alert("Error setting best answer!! Try again");
              console.log(jqXHR+":"+errorThrown);
          }
      });
	// calling Set Vote Answer service
	
	
}

function searchPosts()
{
	var txt = $('#search-criteria').val();
	if(txt=='' || txt ==null)
	{
		$('.top-posts').show();
		}
	else
	{
		$('.top-posts').hide();
	    $('.top-posts').each(function(){
	       if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1){
	           $(this).show();
	       }
	    });
	}
}

function clearSearchResults()
{
	$('#search-criteria').val("");
	$('.top-posts').show();
}

function sortTopQuestions(x)
{
	var $divs = $("div.top-posts");
		if(x==1)
		{
// 			var alphabeticallyOrderedDivs = $divs.sort(function (a, b) {
// 		        return $(a).find("qVoteUp").text() < $(b).find("qVoteUp").text();
// 		    });
// 		    $("#topQuestionsSection").html(alphabeticallyOrderedDivs);
			}
}

function showQuesDesc(x)
{
	$('#myDesc'+x).css('opacity', '1');
}

function loadRecommendations(uid,eventid,qid)
{
	var postData = "uid="+ uid+"&event="+eventid+"&qid="+qid;
		$.ajax({
	          type: "post",
	          url: "services/Recommendations.php",
	          data: postData,
	          contentType: "application/x-www-form-urlencoded",
	          success: function(responseData, textStatus, jqXHR) {
					$("#recommendationSection").empty();
	           		$("#recommendationSection").append(responseData);
	          },
	          error: function(jqXHR, textStatus, errorThrown) {
	              alert("Error setting best answer!! Try again");
	              console.log(jqXHR+":"+errorThrown);
	          }
	      });
}

$(function() {
var availableTags = ["Indian","Chinese","French","Greek","Italian","Thai","Mediterrian","American","Continental","Cuban","Mexican","Malaysian","Singapore","Spanish"];

$( "#tags" ).autocomplete({
    source: availableTags
  });
$( "#ui-id-1").attr("style","z-index:1050");
});
</script>
</head>
<body onload="showMyQuestions();">
	<nav class="navbar navbar-inverse"
		style="background-color: #4d636f; color: white;">
		<div class="container-fluid">
			<div class="navbar-header">
				<img class="navbar-brand" src='./images/FoodieLogo.png'
					style="padding: 5px 10px;">
			</div>
			<ul class="nav navbar-nav">
				<li class="active"><a href="#" style="background-color: #3a4b53;margin-right: 2px;margin-left: 2px;">Top
						Questions</a></li>
				<li class="active" id='postLink' style="display: none; cursor: hand;"><a style="background-color: #3a4b53;margin-right: 2px;margin-left: 2px;"
					data-toggle='modal' data-target='#myPostModal'>Post</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
		<li id="registerLink"><a data-toggle='modal' data-target='#regModal' style='cursor: hand;'>Register</a></li>
				<li id='profileLink'
					style="display: none; cursor: hand; color: white;"><a> Welcome,<?php echo $_SESSION["username"]; ?> </a></li>
				<li id='loginLink'><a data-toggle='modal' data-target='#myModal'
					style='cursor: hand;'>Login</a></li>
				<li id='logoutLink' style="display: none;"><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</nav>

	<div id="aboutUs" style="min-height: 80vh; padding: 10px;">
		<img src='./images/aboutus.png' class="img-responsive">

		<div class="jumbotron" style="background-color: #dcdcdc;">
			"One stop to get all your food related questions answered by experts.
			Post your questions, get answers to your questions, choose the best
			answer, vote answers up/down, see related questions from other
			members, share your thoughts by answering the questions." <br> Our
			mission is to teach and inspire food lovers across the globe by
			sharing talent and knowledge.
		</div>
		
		<b>Top 5 Questions</b>
		<?php 
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
		OR die ('Could not connect to MySQL: '.mysql_error());
		$sql1 = "SELECT Q.qid,qtitle,qcontent,U.uid,created_date,U.username,(select count(*) from answers where qid=Q.qid) as answers,(select count(*) from votes_ques where qid=Q.qid and vote_ques=1) as votesup,(select count(*) from votes_ques where qid=Q.qid and vote_ques=-1) as votesdown,(select sum(vote_ques) from votes_ques where qid=Q.qid) as value FROM question Q,user U WHERE U.uid=Q.uid order by value desc limit 5";
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
			<p class='title' style='cursor: hand;' data-toggle='modal' data-target='#myModal'' >" . $row ["qtitle"] . "</p>
			<p>".$row["qcontent"]."</p>
		</div>
		<div class='col-sm-2'>
		Up: <span  class='badge'>".$row["votesup"]."</span>
		Down: <span class='badge'>".$row["votesdown"]."</span>
		Answers <a href='#'><span  class='badge'>" .$row["answers"]."</span></a>
		</div>
  		<div class='col-sm-3'><p style='word-wrap: break-word;'>Posted by:<br>".$row ["username"]."</p></div>
  		</div>";
			$postinfo = $postinfo . "</div>";
			echo $postinfo;
			$x = $x + 1;
		}
		mysqli_close($conn);
		?>
	</div>
	<div class="row"
		style="margin-left: 0px; margin-right: 0px; min-height: 80vh;">
		<div class="col-sm-6 w3-card-2" id="topQuestionsSection">
		<div class="row" style="padding: 5px; margin:0px;background-color: #1b427;display:none;" id="topbar">
				<input type="text" id="search-criteria" />
				<button id="search" type="button" class="btn btn-default btn-sm" onclick="searchPosts()">
         		<img src="images/magnify.png">
        		</button>
        		<button id="clearSearch" type="button" class="btn btn-default btn-sm" onclick="clearSearchResults()">
         		<img src="images/close-circle.png">
        		</button>
        		<button id="sortTimeAesc" type="button" class="btn btn-default btn-sm" onclick="sortTopQuestions(1)">
         		<img src="images/sort-ascending.png">
        		</button>
        		<button id="sortTimeDesc" type="button" class="btn btn-default btn-sm" onclick="sortTopQuestions(2)">
         		<img src="images/sort-descending.png">
        		</button>
        		<label class="radio-inline"><input type="radio" name="optradio" checked="checked">Date</label>
				<label class="radio-inline"><input type="radio" name="optradio">Score</label>
		 </div>
<?php
function showTopPosts($uid) {
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
	OR die ('Could not connect to MySQL: '.mysql_error());
	$sql1 = "SELECT Q.qid,qtitle,qcontent,U.uid,created_date,U.username,(select count(*) from answers where qid=Q.qid) as answers,(select count(*) from votes_ques where qid=Q.qid and vote_ques=1) as votesup,(select count(*) from votes_ques where qid=Q.qid and vote_ques=-1) as votesdown,(select sum(vote_ques) from votes_ques where qid=Q.qid) as value,(select tags from tags where tag_id=(SELECT tag_id_fk FROM `question_tag` WHERE qid_fk=Q.qid)) as tags FROM question Q,user U WHERE U.uid=Q.uid and U.uid!=".$uid." order by value desc";
	if(!$conn)
	{
		echo "error";
	}
	$rs1 = mysqli_query($conn,$sql1);
	$x = 0;
	while ( $row = mysqli_fetch_assoc ( $rs1 ) ) {
		$postinfo = "<div class='w3-card-2 w3-hover-shadow' style='border-left: 4px solid #009688;' >
		<div class='row post top-posts'>
		<div class='col-sm-7'>
			<p class='title' style='cursor: hand;' data-toggle='collapse' data-target='#collapse" . ($x + 1) . "' >" . $row ["qtitle"] . "</p> 
			<p id='myDesc".($x + 1)."'>".$row["qcontent"]."</p>";
					if($row["tags"]!=null)
								{
									$postinfo = $postinfo ."<a href='#' style='background-color: #5bc0de;color:#ffffff;padding: 5px;'>".$row["tags"]."</a>";
								}
		$postinfo =	$postinfo."</div>
		<div class='col-sm-2'>
		Up: <span id='qVoteUp".$row["qid"]."' class='badge'>".$row["votesup"]."</span>
		Down: <span id='qVoteDown".$row["qid"]."' class='badge'>".$row["votesdown"]."</span>
		Answers <a href='#'><span id='qanswers".$row["qid"]."' class='badge'>" .$row["answers"]."</span></a>
		
		</div>
  		<div class='col-sm-3'><img src='profiles/profile.png' width='50px' height='50px'  class='img-circle img-responsive'' ><!--<p style='word-wrap: break-word;'>Posted by:<br>--><p style='padding: 5px;'>".$row ["username"]."</p><p style='font-size: 12px;color: #0096e1;font-weight: bold;'>".$row ["created_date"]."</p></div>
  		</div>
		<div id='collapse".($x + 1) ."' class='post-footer collapse'><div class='list-group'><div class='list-group-item row' style='margin:0px;'><a href='javascript:voteQuestion(1,".$row["qid"].")'><img width='24px' height='24px' src='./images/ques-up.png'></a>
			<a href='javascript:voteQuestion(-1,".$row["qid"].")'><img width='24px' height='24px' src='./images/ques-down.png' ></a></div>";
		$sql2="SELECT A.aid,A.adesc,U.username,A.best_ans,(select count(*) from votes_ans where aid=A.aid and vote_ans=1) as upvotes,(select count(*) from votes_ans where aid=A.aid and vote_ans=-1) as downvotes,IFNULL((select sum(vote_ans) from votes_ans where aid=A.aid),0) as value FROM answers A,user U WHERE U.uid=A.uid_ans and A.qid=".$row["qid"]." order by value desc";
		$rs2 = mysqli_query($conn,$sql2);
		$bestansid=0;
		$bestrow="";
		while($arow= mysqli_fetch_assoc ( $rs2 ))
		{
			if($arow["best_ans"]==1)
			{
				$bestansid=$arow["aid"];
				$bestrow=$arow;
			}
		}
		mysqli_data_seek($rs2,0);
		$y = 0;
		if($bestansid>0)
		{
			$postinfo = $postinfo . "<div class='list-group-item row' style='margin:0px;'><div class='col-sm-6'>".$bestrow["adesc"]."</div><div class='col-sm-2'>Answered by: <b>".$bestrow["username"]."</b></div><div class='col-sm-1'><span id='qAnsUp".$bestrow["aid"]."'>".$bestrow["upvotes"]."</span><img width='24px' height='24px' src='./images/thumb-up-outline.png' onclick='voteAnswer(1,".$bestrow["aid"].",".$row["qid"].")'></div><div class='col-sm-1' style='cursor:hand;'><span id='qAnsDown".$bestrow["aid"]."'>".$bestrow["downvotes"]."</span><img width='24px' height='24px' src='./images/thumb-down-outline.png' onclick='voteAnswer(-1,".$bestrow["aid"].",".$row["qid"].")' style='cursor:hand;'></div><div class='col-sm-2'><img  class='img-responsive' width='24px' height='24px' src='./images/bestans.png' ></div></div>";
			$y=$y+1;
		}
		while ( $ansrow = mysqli_fetch_assoc ( $rs2 ) ) {
		if($bestansid!=$ansrow["aid"])
				{
					$postinfo = $postinfo . "<div class='list-group-item row' style='margin:0px;'><div class='col-sm-6'>".$ansrow["adesc"]."</div><div class='col-sm-2'>Answered by: <b>".$ansrow["username"]."</b></div><div class='col-sm-1'><span id='qAnsUp".$ansrow["aid"]."'>".$ansrow["upvotes"]."</span><img width='24px' height='24px' src='./images/thumb-up-outline.png' onclick='voteAnswer(1,".$ansrow["aid"].",".$row["qid"].")' style='cursor:hand;'></div><div class='col-sm-1'><span id='qAnsDown".$bestrow["aid"]."'>".$ansrow["downvotes"]."</span><img width='24px' height='24px' src='./images/thumb-down-outline.png' onclick='voteAnswer(-1,".$ansrow["aid"].",".$row["qid"].")' style='cursor:hand;'></div></div>";
				}
			}
		$postinfo = $postinfo . "<div class='list-group-item'><label for='Answer'>Comment:</label><textarea class='form-control' rows='5' id='comment".($x + 1)."' onclick='event.stopPropagation()'></textarea><input type='button' value='Submit' onclick='saveAnswer(1,".($x+1).",".$row["qid"].")'></div>";
		$postinfo = $postinfo . "</div></div></div>";
		echo $postinfo;
		$y = $y + 1;
		$x = $x + 1;
	}
	mysqli_close($conn);
}
// user login code
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
				<div id="myQuesSection" style="opacity: 0;" class="panel panel-info">
					<div class="panel-heading">My Questions</div>
					<div id="myQuesHolder" class="panel-body"
						style="height: 60vh; overflow: scroll;">
					<?php
					if ($_SERVER ['REQUEST_METHOD'] == "POST") {
						if ($uid != 0) {
							$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME)
							OR die ('Could not connect to MySQL: '.mysql_error());
							$sql = "SELECT Q.qid,qtitle,qcontent,U.uid,created_date,U.username,(select count(*) from answers where qid=Q.qid) as answers,(select count(*) from votes_ques where qid=Q.qid) as votes,IFNULL((select sum(vote_ques) from votes_ques where qid=Q.qid),0) as value,(select tags from tags where tag_id=(SELECT tag_id_fk FROM `question_tag` WHERE qid_fk=Q.qid)) as tags FROM question Q,user U WHERE U.uid=Q.uid and U.uid=".$uid." order by value desc";
							$rs = mysqli_query ($conn,$sql );
							$x = 0;
							while ( $row = mysqli_fetch_assoc ( $rs ) ) {
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
								Votes <a href='#'><span class='badge'>".$row["value"]."</span></a>
								Answers <a href='#'><span class='badge'>" .$row["answers"]."</span></a></div>
						  		<div class='col-sm-3'><p style='word-wrap: break-word;'>Posted by:<br>".$row ["username"]."</p></div>
						  		</div>
								<div id='mycollapse" . ($x + 1) . "' class='post-footer collapse'><div class='list-group'>";
								
								$sql2="SELECT A.aid,A.adesc,U.username,A.best_ans,(select count(*) from votes_ans where aid=A.aid and vote_ans=1) as upvotes,(select count(*) from votes_ans where aid=A.aid and vote_ans=-1) as downvotes,IFNULL((select sum(vote_ans) from votes_ans where aid=A.aid),0) as value FROM answers A,user U WHERE U.uid=A.uid_ans and A.qid=".$row["qid"]." order by value desc";
								$rs2 = mysqli_query($conn,$sql2);
								$bestansid=0;
								$bestrow="";
								while($arow= mysqli_fetch_assoc ( $rs2 ))
								{
									if($arow["best_ans"]==1)
									{
										$bestansid=$arow["aid"];
										$bestrow=$arow;
									}
								}
								mysqli_data_seek($rs2,0);
								$y = 0;
								if($bestansid>0)
								{
									$postinfo = $postinfo . "<div class='list-group-item row' style='margin:0px;'><div class='col-sm-6'>".$bestrow["adesc"]."</div><div class='col-sm-2'>Answered by: <b>".$bestrow["username"]."</b></div><a href='#'class='col-sm-1'>".$bestrow["upvotes"]."<img width='24px' height='24px' src='./images/thumb-up-outline.png' ></a><a href='#' class='col-sm-1'>".$bestrow["downvotes"]."<img width='24px' height='24px' src='./images/thumb-down-outline.png' ></a><div class='col-sm-2'><img  class='img-responsive' width='24px' height='24px' src='./images/bestans.png' ></div></div>";
									$y=$y+1;
								}
								while ( $ansrow = mysqli_fetch_assoc ( $rs2 ) ) {
									if($bestansid!=$ansrow["aid"])
									{
										if($bestansid>0)
										{
											$postinfo = $postinfo . "<div class='list-group-item row' style='margin:0px;'><div class='col-sm-6'>".$ansrow["adesc"]."</div><div class='col-sm-2'>Answered by: <b>".$ansrow["username"]."</b></div><a href='#' class='col-sm-1'>".$ansrow["upvotes"]."<img width='24px' height='24px' src='./images/thumb-up-outline.png' ></a><a href='#' class='col-sm-1'>".$ansrow["downvotes"]."<img width='24px' height='24px' src='./images/thumb-down-outline.png' ></a></div>";
										}
										else
										{
										$postinfo = $postinfo . "<div class='list-group-item row' style='margin:0px;'><div class='col-sm-6'>".$ansrow["adesc"]."</div><div class='col-sm-2'>Answered by: <b>".$ansrow["username"]."</b></div><a href='#'class='col-sm-1'>".$ansrow["upvotes"]."<img width='24px' height='24px' src='./images/thumb-up-outline.png' ></a><a href='#' class='col-sm-1'>".$ansrow["downvotes"]."<img width='24px' height='24px' src='./images/thumb-down-outline.png' ></a><div class='col-sm-2'><button onclick='submitBestAns(".$ansrow["aid"].")'>Mark</button></div></div>";
										}
									}
								}
								$postinfo = $postinfo . "<div class='list-group-item'><label for='Answer'>Comment:</label><textarea class='form-control' rows='5' id='mycomment".($x + 1)."' onclick='event.stopPropagation()'></textarea><input type='button' value='Submit' onclick='saveAnswer(2,".($x+1).",".$row["qid"].")'></div>";
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
				<div id="recommendationPanel" class="panel panel-info" style="display: block;">
					<div class="panel-heading">Recommendations</div>
					<div class="panel-body" id="recommendationSection" style="height: auto;">
						<div></div>
					</div>
				</div>
			</div>

		</div>
		
		<!-- Satya: Modal for user registration: -->	
	
		<div class="modal fade" id="regModal" role="dialog">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Create your Foodie account</h4>
					</div>
					<div class="modal-body">
					       	<div class="form-group">
								<label for="email">Email address/User Name:<span style="color: red;">*</span></label> <input type="text"
									class="form-control" name="newUserId" id="newUserId" required>
							</div>
							<div class="form-group">
								<label for="pwd">Password:<span style="color: red;">*</span></label> <input type="password"
									class="form-control" name="newUserPw" id="newUserPw" required>
									<br><p style="font-size: 12px;">Feilds marked <span style="color: red;"> * </span>are mandatory<p>
							</div>
							<button class="btn btn-default" onclick = "regUser()">Register</button>
					 </div>
					<div class="modal-footer"></div>
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
					<div class="form-group">
						<label for="postContent">Tags:</label>
						<input id="tags">
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
