<?php
session_start();
if(isset($_REQUEST['btn_grp'])){
	if(empty($_REQUEST['grp_name'])){
		$grp_name_err="Please Enter a valid group name";

	}
	else{
$h=mysqli_connect("localhost","root","","soc_media");
$query="select id from groups order by id desc;";
$r=mysqli_query($h,$query);
$arr=mysqli_fetch_array($r);
$arr['id']+=1;
$g_name=$_REQUEST['grp_name'];
$user=(string)$_SESSION['user'].",";
$query_ins="insert into groups values(".(string)$arr['id'].",'$g_name','$user','','','');"; 
$r1=mysqli_query($h,$query_ins);
	mkdir("c:/wamp/www/project/".(string)$arr['id']."/");
	$id=$arr['id'];
	$handle=fopen("$id/index.php", "w");
	$data="<?php session_start();
		                       \$h=mysqli_connect('localhost','root','','soc_media');
		                         if(!isset(\$_SESSION['user']))
		                     header('Location:log_page.php'); 
		                        else{
                              
                              \$query='select disp_pic , background from groups where id=".(string)$arr['id'].";';
                               \$r=mysqli_query(\$h,\$query) or die('error1...'); 
                               \$arr=mysqli_fetch_array(\$r) or die('error2..');
                               \$disp_pic=\$arr['disp_pic'];
                               if(\$arr['disp_pic']=='')
                               	\$disp_pic='\project\group_icon.jpeg';  
                                if(isset(\$_REQUEST['btn_sub'])){
                                if(isset(\$_REQUEST['the_post'])){
                                	if(empty(\$_REQUEST['the_post'])){
                                		\$post_err='Please type in to post.';
                                	}
                                	else{
                                		\$num_rows=mysqli_num_rows(mysqli_query(\$h,'select * from messages')) or die('error3..');
                                		\$num_rows++;
                                		\$post=\$_REQUEST['the_post'];
                                		\$group='group'.(string)".(string)$id.";
                                		\$query_ins='insert into messages values('.(string)\$num_rows.',\"'.\$post.'\",'.(string)\$_SESSION['user'].',\"'.\$group.'\",CURRENT_TIMESTAMP);';
                                		\$r=mysqli_query(\$h,\$query_ins) or die('error4..');
                                		\$query_grp='update groups set posts=CONCAT(posts,\"'.(string)\$num_rows.',\") where id=".(string)$id.";';
                                		\$r=mysqli_query(\$h,\$query_grp) or die('error5..');

                                	}
                                }
                                }}
                                  	?>
                                  	<!DOCTYPE HTML>
                                  	<html>
                                  	<head>
                                  	    <title>".$g_name."</title>
                                            <script src='http://code.jquery.com/jquery-2.1.4.min.js'></script>
                                    
                                  	</head>
                                  	<body onload='fetch_post(0);'>
                                  	<h1><i>".$g_name."</i></h1><br/><br/>
                                  	<img src=<?php echo \$disp_pic; ?>"." style='border:1px dashed green;padding:1em;'>
                                  	<br/><br/>
                                  	    <form method='post' id='posting' enctype='multipart/form-data'>
                                          <textarea name='the_post' id='the_post' placeholder='Type in to post...'></textarea>
                                          <input type='submit' value='SUBMIT' name='btn_sub'>
                                        </form>
                                  	 <div id='posts'>
                                  	  
                                  	 </div>
                                  	 </body>
                                     <script type='text/javascript'>
                                     $('#posting').submit(function(){
                                        $.ajax({
                                        
                                        url:'http://localhost/project/get_posts.php',
                                        data:$('#posting').serialize(),
                                        success:function(msg){
                                           document.getElementById('posts').innnerHTML=msg;
                                           }
                                         });
                                         });
                                     function fetch_post(value){
                                      if(value==0){
                                      $.ajax({
                                        type:'POST',
                                        url:'http://localhost/project/get_posts.php',
                                        data:{grp_id:".(string)$id.",val:value},
                                        success:function(msg){
                                           document.getElementById('posts').innerHTML=msg;
                                           }
                                         }); }
                                      
                                        
                                      

                                      }
                                     </script>
                                  	 </html>
                                  	";
	fwrite($handle,$data);
	header("Location:".(string)$arr['id']."/");
}

}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="group_creator.php" method="post" enctype="multipart/form-data">
	Group Name: <input type="text" name="grp_name"><span class="error"><?php if(isset($grp_name_err)) echo $grp_name_err;?></span>
	<br/><br/>
<input type="submit" value="submit" name="btn_grp">
</form>
</body>
</html>