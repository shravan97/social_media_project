<?php 
session_start();
if(!isset($_SESSION['user'])){
	header("Location:log_page.php");

}
else{
	$h=mysqli_connect("localhost","root","","soc_media");
    $query="select * from stud_details where roll_no=".(string)$_REQUEST['user'];
    $r=mysqli_query($h,$query);
    $arr=mysqli_fetch_array($r);
$name=$arr['name'];

$prof_pic=$arr['prof_pic'];
$background=$arr['background'];
$background=preg_replace("/ /", "%20",$background);
}	
	?>
<!DOCTYPE HTML>
<html>
<head>
	<title> <?php echo $name; ?> </title>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>

<!-- Optional theme -->
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css'>
<link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
<!-- Latest compiled and minified JavaScript -->

<script src='http://code.jquery.com/jquery-2.1.4.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>

<style type='text/css'>
	nav{ position: fixed;
		top:0px;
		left: 0px;
		height : 2.9em;
      background-color: blue;
    -webkit-box-shadow: 2px 2px 6px ;
    -moz-box-shadow:    2px 2px 6px ;
    box-shadow:         2px 2px 6px ;
    z-index:10;

	}
	ul{  margin-top: 0.5em;
		list-style-type: none;
	}
	li{
		display: inline;
	}
	a{
		text-decoration: none;
	}
	img#logo{ border-radius: 1.1em;
		height: 2.2em;
		width: 2.2em;
	}
	.to_right{
		float: right;
		padding: 0.2em;
	}
	#profile_pic , .y_p{
		width:20em;
		height: 15em;
	}
	body::after{
		content: "";
		opacity: 0.7;
		z-index: -1;
		background: url(<?php if(isset($background))echo "http://localhost/".(string)$_REQUEST['user']."/".$background; ?>);
		/*-webkit-background-size: cover;*/
		background-repeat: no-repeat;
        background-position: center center;
        
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background-size: 70% 90%;
        
          /*background-color:rgba(0, 0, 0, 0.5);*/

	}
</style>
</head>
<body onload='width_assign();'>
<nav id='navbar'>
 <ul>
   <li><a href='http://www.nitt.edu' target='_blank'><img id='logo' src='http://localhost/project/nitt_logo.jpg' /></a></li>
   <li class='to_right'> <a href='/project/index.php?logout=true' class='btn btn-primary btn-lg active' style='padding:0em;'>logout</a></li> 	
   
 </ul>
</nav>
<div id='below_nav' style='position:absolute;top:3.5em;left:2em;'>
<!--<div id='message' class='collapse'>
<form action='posts.php' method='post' enctype='multipart/form-data'>
TO: <input type='text' name='roll_no'><br/><br/>
<textarea style='border-radius:5px;' name='post' placeholder='Type in 
 here to post...'></textarea>
<input type='submit' name='btn_sub' style='border-radius:0.4em;'>
</form>
</div>-->
<div id='prof_pic'><img id='profile_pic' src=<?php echo"'../".(string)$_REQUEST['user'].'/'.$prof_pic."'"; ?>></div>
<div id='uploader' class='collapse'>
<br/>
<br/>
</div>
<br/>
<div id='posts' style='position:relative;top:10em;'></div>
<br/><br/>
<form method='post' action='search.php' enctype='multipart/form-data'>
<input type='search' name='search_query' id='sr' placeholder='search for user/group...'>
<input type='submit' value='SEARCH' name='s_btn_sub' class='btn btn-primary' href='#search' role='button' data-toggle='modal'  aria-expanded='false'><?php 
if(isset($_REQUEST['s_empty']))
	echo 'Pls enter a valid roll no. to search for';
?>
</form>
<br/><br/>
<div class='collapse' id='photos'>PHOTOS : 
	<?php $c=0;
         $arr=scandir('../'.(string)$_REQUEST['user']);
         for($i=2;$i<count($arr);$i++){
         	if($arr[$i]!='default.png'){
         	echo "<img class='y_p' src='../".(string)$_REQUEST['user'].'/'.$arr[$i]."'>";
         $c++;  } 
     }
if($c==0)echo "No photos";
	
	?>
	
</div>
<br/><br/>
<a class='btn btn-primary' role='button' data-toggle='collapse' href='#photos' aria-expanded='false' aria-controls='photos'>
 PHOTOS</a>
<!--<a class='btn btn-primary' href='#search' id='sl' role='button' data-toggle='modal'  aria-expanded='false'>
  search</a>
<div id='search' class='modal' role='dialog'>
<div class='modal-dialog' role='document'>
<div class='modal-content'>
<div class='modal-header text-center'>SEARCH<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</button></div>
<div class='modal-body'>

</div>
</div>
</div>
</div>-->

</div>
</body>
<script type='text/javascript'>
	function width_assign(){
		document.getElementById('navbar').style.width = window.innerWidth + 'px';
	}
	window.onresize = width_assign;

</script>
</html>