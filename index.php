<html>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style type="text/css">
  .title
  {
  	color: grey;
  	font-weight: bold;
  }
  .post
  {
  	 padding: 10px;
  	 margin: 2vh;
  }
  </style>
<script type="text/javascript">
</script>
</head>
<body>
<nav class="navbar navbar-default">
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
  </div>
</nav>
<?php
for ($x = 0; $x <= 10; $x++) {
    echo "<div class='row post w3-card-2'>
		<div class='col-sm-3'>
		<a href='#'>Votes <span class='badge'>".rand(0,20)."</span></a>
		<a href='#'>Answers <span class='badge'>".rand(0,20)."</span></a>
		<a href='#'>Views <span class='badge'>".rand(0,20)."</span></a>
		</div>
		<div class='col-sm-8'>
			<p class='title'>Why is PHP called Hypertest Preprocessor why not Personal Home Page ?</p> 
			<p>
 			<button type='button' class='btn btn-info'>Php</button>
 		<button type='button' class='btn btn-primary'>Technology</button>
 			</p>
		</div>
  		<div class='col-sm-1'><p>Posted by: Kumar</p></div>
  		</div>";
} 
?>
</body>
</html>
