<?php
$track_id=$_GET['a'];
$base_dir = "/home/mh/soma/webpage";
include("$base_dir/include/config/config.php");
$q="delete from sources where id=$track_id;";
$sql_result=mysql_query($q, $db_conn);        
?>