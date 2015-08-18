<?php 
if(isset($_REQUEST['btn_sub'])){

if(!empty($_REQUEST['roll_no'])&& !empty($_REQUEST['pwd'])) {
//echo gettype($_REQUEST['roll_no']);
	
 $roll=$_REQUEST['roll_no'];$pwd=$_REQUEST['pwd'];
 $h=mysqli_connect("localhost","root","","soc_media") or die("error.... ".mysqli_error($h));
	$query="select * from stud_details where roll_no=".$roll." and pwd='$pwd';";
 
 		
	
if(!preg_match("/\D/", $roll)){ 
$r=mysqli_query($h,$query) or die("error.... ".mysqli_error($h));
$row=mysqli_num_rows($r);
 $arr = mysqli_fetch_assoc($r);
}
else
 $row=0;
	if($row!=0)
	{session_start();$_SESSION['user']=$_REQUEST['roll_no'];
        $_SESSION['name']=$arr['name'];
       header("Location:index.php");}
      
      else{
      	$err="Invalid Credentials.";
      	
      } 


}
else $err="One or more fields are empty.";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<fieldset style="position:absolute;top:40%;left:40%;margin:0 auto;">
	<legend style="border:1px solid black;">
		LOGIN 
	</legend>
	<form method="post" action="log_page.php" enctype="multipart/form-data">
	ROLL NO. :<input type="number" name="roll_no">
	<br/><br/>
	PASSWORD :<input type="password" name="pwd">
	<br/><br/>
	<span class="error"><?php if(isset($err)) echo $err."<br/>"; ?></span> 
	<input type="submit" value="SUBMIT" name="btn_sub">
	</form>
</fieldset>
</body>
</html>