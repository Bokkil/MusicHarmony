<?php
  header('Content-Type: text/html; charset=utf-8');
  session_cache_expire(1800);
  session_start();

  $project_id=$_GET['a'];
  $user_id=$_SESSION["user_id"];
  $base_dir = "/home/mh/soma/webpage";
  include("$base_dir/include/config/config.php");
  $q="select * from users_projects where user_id='$user_id' and project_id='$project_id';";
  $sql_result=mysql_query($q, $db_conn);

  $count=mysql_num_rows($sql_result);

  echo("$count");
?>