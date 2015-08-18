<?php
session_start(); 
if(!isset($_SESSION['user']))
	header("Location:log_page.php");
else{
	if (empty($_REQUEST['search_query'])) {
		header("Location:index.php?s_empty=145345fcdfgdfg");

	}
	else{
		$h=mysqli_connect("localhost","root","","soc_media");
		$query="select roll_no from stud_details where roll_no like '%".(string)$_REQUEST['search_query']."%';";
	    $r=mysqli_query($h,$query);
       
echo "<!DOCTYPE html>
<html>
<head>
	<title>search for ".(string)$_REQUEST['search_query']."</title>
</head>
<body>
";

	   while ($arr=mysqli_fetch_array($r)) 
	   {
	   	echo "<a href='";
          if($arr['roll_no']==$_SESSION['user'])
          	echo "index.php";
          else
          	echo "page_generate.php?user=".$arr['roll_no'];

	   	echo "'>".(string)$arr['roll_no']."</a><br/>";
	   }
	}
}
?>
</body>
</html>