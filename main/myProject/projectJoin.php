<?php
	$base_dir = "/home/mh/soma/webpage";
  include("$base_dir/include/config/config.php");

  function p_join($user_id,$project_id)
  {
    include("../include/config/config.php");

    $sql = "select * from users_projects where user_id='$user_id' AND proejct_id='$proejct_id'";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    if($res)
    	return 0;
    else
    {
	    $sql = "Insert into users_projects (user_id,project_id) values('$user_id','$project_id'";
	    $res = mysql_query($sql);
	    return 1;
  	}
  }
?>