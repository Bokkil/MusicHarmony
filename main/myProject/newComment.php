<?php
	$base_dir = "/home/mh/soma/webpage";
	include("$base_dir/include/config/config.php");

	$content = $_REQUEST['content'];
	$project_id = $_REQUEST['project_id'];
	$user_id = $_REQUEST['user_id'];
	$sql = "Insert into comments (pri_user_id,created_at,project_id,CONTENTS) values('$user_id',NOW(),'$project_id','$content')";
	$res = mysql_query($sql);

	header("Location: /main/myProject/projectBottom.php");
?>