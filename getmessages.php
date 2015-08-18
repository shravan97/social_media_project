<?php 
session_start();

if(!isset($_SESSION['user']))
header("Location:log_page.php");
else{
	$frm_arr = array();
	$to_arr = array();
	$roll=$_SESSION['user'];
	$h=mysqli_connect("localhost","root","","soc_media");
   
  function message($r){
  	$h=mysqli_connect("localhost","root","","soc_media");
  for($i=0;$i<count($r);$i++){
  	$other=$r[$i];
  	$roll=$_SESSION['user'];
	$query="select * from messages where to_people='$roll' and from_roll=".(string)$other." or from_roll=".(string)$roll." and to_people='$other';";
	$r1=mysqli_query($h,$query);
	echo "<a href='#".(string)$other."' class='btn btn-primary' role='button' data-toggle='collapse'  aria-expanded='false' aria-controls='".(string)$other."'>".(string)$other."</a>";
	echo "<table id='".(string)$other."' class='collapse'>";
	echo"<tr>
            <td style='border:1px solid black;'><a href='page_generate.php?user=".(string)$other."'>".(string)$other."</td>
        </tr>";
	while($arr=mysqli_fetch_array($r1)){
         
          echo "<tr><td style='border:1px dashed black;";
      if($_SESSION['user']==$arr['from_roll'])
      	  echo"color:green;";
      	else echo "color:blue;text-align:right;";
          echo"'>".$arr['content']."</td>
          </tr>";    


	}
  echo "<tr>
         <td><input type='text' name='".(string)$other."'></td>
         </tr>";
  echo "</table>"; }

}
	$query_roll="select distinct(to_people) from messages where from_roll=".(string)$_SESSION['user']." and to_people not like '%group%';";
    $r=mysqli_query($h,$query_roll);
    while($text=mysqli_fetch_array($r)){
    	array_push($frm_arr, $text['to_people']);
    } 
    ?>
<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<!-- Latest compiled and minified JavaScript -->

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>
<body>



    <?php
    echo "<table>";
    message($frm_arr);
    
    $query_roll="select distinct(from_roll) from messages where to_people='$roll';";
    $r=mysqli_query($h,$query_roll);
    while($arr=mysqli_fetch_array($r)){
   if(!in_array((string)$arr['from_roll'],$frm_arr)){
   	
   	array_push($to_arr, $arr['from_roll']);
   }

    }
    message($to_arr);
echo"</table>";
}


?>
<a href="index.php">HOME</a>
</body>
</html>