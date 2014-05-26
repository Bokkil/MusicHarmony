
<?php
	$base_dir = "/home/mh/soma/webpage";
	include("$base_dir/include/config/config.php");

	function goodComment($project_id, $user_id)
	{
		$sql_project = "select TITLE from projects where id='$project_id';";
		$res_project = mysql_query($sql_project);
		$project_name = mysql_result($res_project, 0);
 
		$sql_user = "select NAME from users where id='$user_id'";
		$res_user = mysql_query($sql_user);
		$user_name = mysql_result($res_user, 0);

		$content = "$user_name"."님이 "."$project_name"."을(를) 좋아합니다.";
		$sql="insert into comments (pri_user_id, project_id,created_at,CONTENTS,TYPE) values ('$user_id', '$project_id',NOW(),'$content','1');";
		$res=mysql_query($sql);
	}

	function downloadComment($project_id, $user_id)
	{
		$sql_project = "select TITLE from projects where id='$project_id';";
		$res_project = mysql_query($sql_project);
		$project_name = mysql_result($res_project, 0);
 
		$sql_user = "select NAME from users where id='$user_id'";
		$res_user = mysql_query($sql_user);
		$user_name = mysql_result($res_user, 0);

		$content = "$user_name"."님이 "."$project_name"."을(를) 다운로드 하였습니다.";
		$sql="insert into comments (pri_user_id, project_id,created_at,CONTENTS,TYPE) values ('$user_id', '$project_id',NOW(),'$content','2');";
		$res=mysql_query($sql);
	}

	function joinComment($project_id, $user_id)
	{
		$sql_project = "select TITLE from projects where id='$project_id';";
		$res_project = mysql_query($sql_project);
		$project_name = mysql_result($res_project, 0);
 
		$sql_user = "select NAME from users where id='$user_id'";
		$res_user = mysql_query($sql_user);
		$user_name = mysql_result($res_user, 0);

		$content = "$user_name"."님이 "."$project_name"."에 참가 하였습니다.";
		$sql="insert into comments (pri_user_id, project_id,created_at,CONTENTS,TYPE) values ('$user_id', '$project_id',NOW(),'$content','3');";
		$res=mysql_query($sql);
	}

	function uploadSource($project_id, $user_id)
	{
		$sql_project = "select TITLE from projects where id='$project_id';";
		$res_project = mysql_query($sql_project);
		$project_name = mysql_result($res_project, 0);
 
		$sql_user = "select NAME from users where id='$user_id'";
		$res_user = mysql_query($sql_user);
		$user_name = mysql_result($res_user, 0);

		$content = "$user_name"."님이 "."$project_name"."에 새로운 음원을 추가 하였습니다.";
		$sql="insert into comments (pri_user_id, project_id,created_at,CONTENTS,TYPE) values ('$user_id', '$project_id',NOW(),'$content','4');";
		$res=mysql_query($sql);

	}

	$flag = $_GET['b'];
	$down_id=$_GET['a'];
	if($flag == 2)
	{
		session_start();
		$user = $_SESSION["user_id"];
		downloadComment($down_id, $user);
	}

?>