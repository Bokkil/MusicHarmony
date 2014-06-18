<?php
$base_dir = "/home/mh/soma/webpage";
include("$base_dir/include/config/config.php");
	$user_id=$_SESSION["user_id"];
	$project_id = $_SESSION["project_id"];
	$sql="select * from sources where project_id='$project_id' order by created_at desc;";
	$res=mysql_query($sql);        
	$cnt=mysql_num_rows($res);

	for($i=0;$i<$cnt;$i++)
	{
		$comment=mysql_result($res, $i , 'COMMENT');
		$source_path=mysql_result($res,$i, 'SOURCES_PATH');
		$created_at= substr(mysql_result($res, $i,'created_at'), 0,10);
		$pri_user_id=mysql_result($res,$i,'pri_user_id');
		$source_id=mysql_result($res,$i,'id');

		$sql2 = "select * from users where id='$pri_user_id'";
		$res2=mysql_query($sql2);
		$picture_path=mysql_result($res2,0,'PICTURE');
		
		$user_name = mysql_result($res2, 0, 'NAME');
		echo("
			<div class=\"row pi-content-area\">
				<div class=\"col-md-2 pi-track-user-img-area\">
					<img onclick=\"user_info_parents($pri_user_id);\" class=\"pi-user-img left\" src=\"/uploads/userImg/$picture_path\"/>
				</div>
				<div class=\"col-md-10\">
				  <div onclick=\"user_info_parents($pri_user_id);\" class=\"pi-track-user-name pointer\"> $user_name  </div>
				 ");
		if($user_id==$pri_user_id){
		echo("
				  	<a type=\"button\" onclick=\"track_delete($source_id)\" class=\"track-delete-button favoritelist-button favorite-delete-button\"></a>
		");
		};
		echo("
					<div class=\"pi-track-user-commnet\"> $comment </div>
					<div class=\"\">$source_path</div>
					<div class=\"right\"> $created_at </div>
				</div>
				<div class=\"source-player clear\">
				  <audio id=\"audio-player\" src=\"/uploads/source/$source_path\" class=\"audio-track\" type=\"audio/mp3\" controls=\"controls\"></audio>
				</div>
			</div>
		");
	}
?>