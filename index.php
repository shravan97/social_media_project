<?php 
/*set photos from 'YOUR PHOTOS' list , as prof pic.
  send messages
*/
session_start();
if(isset($_SESSION['user']))
{
$name = $_SESSION['name'];
}
else header("Location:/project/log_page.php");
if(isset($_REQUEST['logout']))
{unset($_SESSION['user']);unset($_SESSION['name']);
header("Location:/project/log_page.php");
}
$h=mysqli_connect("localhost","root","","soc_media");
if(isset($_REQUEST['btn_sub'])){
	if(empty($_FILES['prof_pic_img']['name']) || (!(preg_match("/.jpg/", $_FILES['prof_pic_img']['name'])) && !(preg_match("/.ico/", $_FILES['prof_pic_img']['name'])) && !(preg_match("/.png/", $_FILES['prof_pic_img']['name']))))
		$prof_err="Pls upload a proper picture with extensions of .jpg or .ico or .png";
	else {move_uploaded_file($_FILES['prof_pic_img']['tmp_name'], "..\\".(string)$_SESSION['user']."\\".$_FILES['prof_pic_img']['name']);
            //echo $_FILES['prof_pic_img']['tmp_name']."<br/>".$_FILES['prof_pic_img']['name']."<br/>";
		 $file_name=$_FILES['prof_pic_img']['name'];
		$query_ins="update stud_details set prof_pic='$file_name' where roll_no=".(string)$_SESSION['user'].";";
	    $r=mysqli_query($h,$query_ins);
	}
}

if(isset($_REQUEST['btn_new_photo'])){
  if(empty($_FILES['new_photo']['name']) || (!(preg_match("/.jpg/", $_FILES['new_photo']['name'])) && !(preg_match("/.ico/", $_FILES['new_photo']['name'])) && !(preg_match("/.png/", $_FILES['new_photo']['name']))))
		$new_photo_err="Pls upload a proper picture with extensions of .jpg or .ico or .png";
	else {move_uploaded_file($_FILES['new_photo']['tmp_name'], "..\\".(string)$_SESSION['user']."\\".$_FILES['new_photo']['name']);
          header("Location:index.php");       
}
}

if(isset($_REQUEST['btn_background'])){
  if(empty($_FILES['background']['name']) || (!(preg_match("/.jpg/", $_FILES['background']['name'])) && !(preg_match("/.ico/", $_FILES['background']['name'])) && !(preg_match("/.png/", $_FILES['background']['name']))))
		$background_err="Pls upload a proper picture with extensions of .jpg or .ico or .png";
	else {move_uploaded_file($_FILES['background']['tmp_name'], "..\\".(string)$_SESSION['user']."\\".$_FILES['background']['name']);
          $background=$_FILES['background']['name'];
          $query_bg="update stud_details set background='$background' where roll_no=".(string)$_SESSION['user'].";";
          $r=mysqli_query($h,$query_bg);
          header("Location:index.php");       
}
}


$query="select prof_pic , background from stud_details where roll_no=".(string)$_SESSION['user'].";";
$r=mysqli_query($h,$query);
$arr=mysqli_fetch_array($r);
$prof_pic=$arr['prof_pic'];
if(!empty($arr['background']))
{   $background=$arr['background'];
	$background = preg_replace('/\s+/', '%20', $background);

}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $name; ?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<!-- Latest compiled and minified JavaScript -->

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<style type="text/css">
	nav{ position: fixed;
		top:0px;
		left: 0px;
		height : 2.9em;
      background-color: blue;/*This stratement is in case the browser doen't support
                                                                             linear gradient*/
         	background-image: -webkit-linear-gradient(left,blue,white);/* for chrome and safari */
         	background-image: -moz-linear-gradient(left,blue,white);/*for firefox */
         	background-image: -o-linear-gradient(left,blue,white);/*for opera */
         	background-image: linear-gradient(left,blue,white);/* for IE */
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
		border:2px solid #A54174;
		padding: 0.5em;
	}
	.welcome{
		font-weight: bolder;
		
	}
	body::after{
		content: "";
		opacity: 0.7;
		z-index: -1;
		background: url(<?php if(isset($background))echo "http://localhost/project/".(string)$_SESSION['user']."/".$background; ?>);
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
<body onload="width_assign();">
<nav id="navbar">
 <ul>
   <li><a href="http://www.nitt.edu" target="_blank"><img id="logo" src="http://localhost/project/nitt_logo.jpg" /></a></li>
   <li class="to_right"> <a href="/project/index.php?logout=true" class="btn btn-primary btn-lg active" style="padding:0em;">logout</a></li> 	
   <li class="welcome"><?php echo "HI \xa0".strtoupper($name)."\xa0"; ?>   </li>
 </ul>
</nav>
<div id="below_nav" style="position:absolute;top:3.5em;left:2em;">
<!--<div id="message" class="collapse">
<form action="posts.php" method="post" enctype="multipart/form-data">
TO: <input type="text" name="roll_no"><br/><br/>
<textarea style="border-radius:5px;" name="post" placeholder="Type in 
 here to post..."></textarea>
<input type="submit" name="btn_sub" style="border-radius:0.4em;">
</form>
</div>-->
<div id="prof_pic"><a href="<?php  echo "/project/".(string)$_SESSION['user'].'/'.$prof_pic; ?>"><img id="profile_pic" src="<?php echo "/project/".(string)$_SESSION['user'].'/'.$prof_pic;  ?>"></a></div>
<div id="uploader" class="collapse">
<br/>
<form method="post" action="index.php" enctype="multipart/form-data">
<input type="file" name='prof_pic_img'>
<br/>
<input type="submit" name="btn_sub">
</form>
<br/>
</div>
<br/>
<div id="posts" style="position:relative;top:10em;"></div>
<a class="btn btn-primary" role="button" data-toggle="collapse" href="#uploader" aria-expanded="false" aria-controls="uploader">
 
  <?php if($prof_pic!="default.jpg") echo"upload another";
      else echo "upload"; ?>
</a>
<span class="error"><?php if(isset($prof_err)) echo $prof_err ?></span>
<br/><br/>
<form method="post" action="search.php" enctype="multipart/form-data">
<input type="search" name="search_query" id="sr" placeholder="search for user/group...">
<input type="submit" value="SEARCH" name="s_btn_sub" class="btn btn-primary" href="#search" role="button" data-toggle="modal"  aria-expanded="false">
<?php 
if(isset($_REQUEST['s_empty']))
	echo "Pls enter a valid roll no. to search for";
?>
</form>
<div class="collapse" id="photos"> YOUR PHOTOS : <br/>&nbsp;
	<?php 
         $arr=scandir("../".(string)$_SESSION['user']);
         for($i=2;$i<count($arr);$i++){
         	echo "<a href='/project/".(string)$_SESSION['user']."/".$arr[$i]."'><img class='y_p' src='/project/".(string)$_SESSION['user']."/".$arr[$i]."'></a>";
          if(($i-1)%3==0)
          	echo "<br/> &nbsp;";
         } 

	?>
	<br/>
	<div class="collapse" id="new_upload">
		<form action="index.php" method="post" enctype="multipart/form-data">
			<input type="file" name="new_photo" accept="image/*">
            <br/>
            <input type="submit" name="btn_new_photo">  
		</form>
	</div>
	<a class="btn btn-primary" role="button" data-toggle="collapse" href="#new_upload" aria-expanded="false" aria-controls="new_upload">
Upload photos</a><span class="error"><?php if(isset($new_photo_err)) echo $new_photo_err; ?></span>
<br/><br/>
</div>
<a class="btn btn-primary" role="button" data-toggle="collapse" href="#photos" aria-expanded="false" aria-controls="photos">
YOUR PHOTOS</a>
<br/><br/>
<div id="set_bga" class="collapse">
	<form action="index.php" method="post" enctype="multipart/form-data">
		<input type="file" name="background">		          
		<input type="submit" name="btn_background">
	</form>
</div>
<a class="btn btn-primary" role="button" data-toggle="collapse" href="#set_bga" aria-expanded="false" aria-controls="set_bga">
SET BACKGROUND !</a>
<span class="error"><?php if(isset($background_err)) echo $background_err; ?></span>
<br/>
<br/>

<!--<a class="btn btn-primary" href="#search" id="sl" role="button" data-toggle="modal"  aria-expanded="false">
  search</a>
<div id="search" class="modal" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header text-center">SEARCH<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button></div>
<div class="modal-body">

</div>
</div>
</div>
</div>-->
<a class="btn btn-primary" href="getmessages.php">Messages</a>
<a class="btn btn-primary" href="group_creator.php">Create Group</a>
</div>
<br/>

</body>
<script type="text/javascript">
	function width_assign(){
		document.getElementById('navbar').style.width = window.innerWidth + 'px';
	}
	window.onresize = width_assign;
function searcher(){
//window.location.href="#search";
//document.getElementById('sl').href="index.php#search?search="+document.getElementById('sr').value;
}
</script>
</html>