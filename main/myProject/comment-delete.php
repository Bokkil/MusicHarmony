<?php
$comment_id=$_GET['a'];
$base_dir = "/home/mh/soma/webpage";
include("$base_dir/include/config/config.php");
$q="delete from comments where id=$comment_id;";
$sql_result=mysql_query($q, $db_conn);        
?>