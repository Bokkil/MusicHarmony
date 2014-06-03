<?php
	// $base_dir = "/home/mh/soma/webpage";
	// include("$base_dir/include/config/config.php");
	$db_host		= "localhost";
	$db_user		= "mh";
	$db_password	= "thak2014";
	$db_dbname  = "mh";
	$db_conn    = mysql_connect($db_host, $db_user, $db_password);
	mysql_select_db($db_dbname, $db_conn);
	$user_id=$_SESSION["user_id"];
	$project_id = $_SESSION["project_id"];
	$sql="select * from comments where project_id='$project_id' and TYPE='0' order by created_at desc;";
	$res=mysql_query($sql);        
	$cnt=mysql_num_rows($res);


	for($i=0;$i<$cnt;$i++)
	{
		$comment=mysql_result($res, $i , 'CONTENTS');
		$created_at= substr(mysql_result($res, $i,'created_at'), 0,10);
		$pri_user_id=mysql_result($res,$i,'pri_user_id');
		$source_id=mysql_result($res,$i,'id');

		$sql2 = "select * from users where id='$pri_user_id'";
		$res2=mysql_query($sql2);
		$picture_path=mysql_result($res2,0,'PICTURE');
		
		if($picture_path == "")
			$picture_path = "def.jpg";

		$user_name = mysql_result($res2, 0, 'NAME');

		echo("
			<div class=\"row pi-content-area-comment\">
				<div class=\"col-md-2 pi-track-user-img-area\">
					<img onclick=\"user_info_parents($pri_user_id);\" class=\"pi-user-img left\" src=\"/uploads/userImg/$picture_path\"/>
				</div>
				<div class=\"col-md-10\">
				  <div onclick=\"user_info_parents($pri_user_id);\" class=\"pi-comment-user-name pointer\"> $user_name </div>
				  ");
		if($user_id==$pri_user_id){
		echo("
				  	<a type=\"button\" onclick=\"comment_delete($source_id)\" class=\"track-delete-button favoritelist-button favorite-delete-button\"></a>
		");
		};
		echo("
				 
					<div class=\"pi-track-user-commnet\"> $comment </div>
					<div class=\"right\"> $created_at </div>
				</div>
			</div>	
			");
	}
?>

