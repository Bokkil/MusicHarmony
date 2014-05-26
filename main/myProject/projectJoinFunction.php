<?php
	header('Content-Type: text/html; charset=utf-8');
	session_cache_expire(1800);
	session_start();

	$project_id=$_GET['a'];
	$user_id=$_SESSION["user_id"];
	$base_dir = "/home/mh/soma/webpage";
	include("$base_dir/include/config/config.php");
	$q="insert into users_projects (user_id, project_id) values ('$user_id', '$project_id');";
	$sql_result=mysql_query($q, $db_conn);       

	include("$base_dir/main/myProject/addComment.php");
	joinComment($project_id, $user_id);
?>