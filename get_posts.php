<?php session_start();
                                      $h=mysqli_connect("localhost","root","","soc_media");
                                  	  if(isset($_REQUEST['the_post'])){
                                     
                                    $num_rows=mysqli_num_rows(mysqli_query($h,'select * from messages')) or die('error3..');
                                    $num_rows++;
                                    $post=$_REQUEST['the_post'];
                                    $group='group'.(string)$_REQUEST['grp_id'];
                                    $query_ins='insert into messages values('.(string)$num_rows.',"'.$post.'",'.(string)$_SESSION['user'].',"'.$group.'",CURRENT_TIMESTAMP);';
                                    $r=mysqli_query($h,$query_ins) or die('error4..');
                                    $query_grp='update groups set posts=CONCAT(posts,"'.(string)$num_rows.',") where id='.(string)$_REQUEST['grp_id'].';';
                                    $r=mysqli_query($h,$query_grp) or die('error5..');


                                  }
                                      

                                      $query='select posts from groups where id='.(string)$_REQUEST['grp_id'].';';
                                  	  $r=mysqli_query($h,$query);
                                  	  $arr=mysqli_fetch_array($r);
                                  	  if($arr['posts']!=''){
                                  	  	$arr_posts=preg_split('/,/', $arr['posts']);
                                  	  	for($i=0;$i<count($arr_posts)-1;$i++){
                                  	  		$query='select * from messages where id='.(string)$arr_posts[$i].';';
                                  	  		$r=mysqli_query($h,$query);
                                  	  		$arr_temp=mysqli_fetch_array($r);
                                  	  		echo '<a href="/project/page_generate.php?user='.$arr_temp['from_roll'].'">'.$arr_temp['from_roll'].'</a><br/><br/>'.$arr_temp['content'].'<br/><br/><hr/>';
                                  	  	}
                                  	  }

                                  	 ?>