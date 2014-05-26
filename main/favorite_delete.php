<?php
header('Content-Type: text/html; charset=utf-8');
session_cache_expire(1800);
session_start();

$goodProject_project_id=$_GET['a'];
$user_id=$_SESSION["user_id"];
$base_dir = "/home/mh/soma/webpage";
include("$base_dir/include/config/config.php");
$q1="update projects set GOOD_COUNT=GOOD_COUNT-1 where id='$goodProject_project_id';";
$sql_result=mysql_query($q1, $db_conn);        
$q2="delete from favorite where user_id='$user_id' and project_id='$goodProject_project_id';";
$sql_result=mysql_query($q2, $db_conn);   
?>