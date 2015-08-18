<?php 


if(isset($_REQUEST['btn_sub']))
{ session_start();
	$post=$_REQUEST['post'];
	$h=mysqli_connect("localhost","root","","soc_media");
	$query="select * from messages;";
	$r=mysqli_query($h,$query);
	if(!$r)
    $rows=mysqli_num_rows($r); 
    else $rows=0;

    $rows++;
    $from=$_SESSION['user'];
    $to = $_REQUEST['roll_no'];
    $query_ins="insert into messages values($rows,'$post',$from,'$to');";
    $r=mysqli_query($h,$query_ins)or die("Error....".mysqli_error($h));
    /*$query1="update stud_details set post_ids=concat(post_ids,'$rows',',') where roll_no=".(string)$_SESSION['roll_no'].";";
    $query2="update stud_details set post_ids=concat(post_ids,'$rows',',') where roll_no=".(string)$_REQUEST['roll_no'].";";
   
   $r1=mysqli_query($h,$query1);
   $r2=mysqli_query($h,$query2);*/
   header("Location:index.php");  
 }
?>