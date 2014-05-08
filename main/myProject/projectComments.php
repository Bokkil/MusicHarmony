<?php
	$base_dir = "/home/mh/soma/webpage";
	include("$base_dir/include/config/config.php");
	$user_id=$_SESSION["user_id"];
	$project_id = $_SESSION["project_id"];
	$sql="select * from comments where project_id='$project_id';";
	$res=mysql_query($sql);        
	$cnt=mysql_num_rows($res);
	for($i=0;$i<$cnt;$i++)
	{
		$content=mysql_result($res, $i , 'CONTENTS');
		//echo($content."\n");
	}
?>
<hr style="margin-top: 0px; margin-bottom: 15px;" />
<div> asdfsdfds </div>
<hr style="margin-top: 0px; margin-bottom: 15px;" />
<div> asdfsdfds </div>
<div> asdfsdfds </div>
<div> asdfsdfds </div>
<div> asdfsdfds </div>