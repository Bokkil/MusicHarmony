<?php
	$base_dir = "/home/mh/soma/webpage";
	include("$base_dir/include/config/config.php");
	
	session_start();
	$user_id = $_SESSION['user_id'];
	$project_id = $_SESSION['project_id'];
	$uploaddir = "$base_dir/uploads/source/";
	$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
	$type = $_FILES['userfile']['type'];

	$valid_extension = array('.mp3', '.mp4', '.wav');
	$file_extension = strtolower( strrchr( $_FILES["userfile"]["name"], "." ) );

	if( in_array( $file_extension, $valid_extension ) &&  $_FILES["userfile"]['size'] < 20971520)
	{
    echo("<pre>");
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
		{
				include("$base_dir/main/myProject/addComment.php");
				uploadSource($project_id, $user_id);

		    $source_path = $_FILES["userfile"]["name"];
		    $comment = $_REQUEST['comment'];
		    $sql = "insert into sources (pri_user_id, project_id,created_at,COMMENT,SOURCES_PATH) values ('$user_id', '$project_id',NOW(),'$comment','$source_path');";
		    $res = mysql_query($sql);
		    header("Location: /main/myProject/projectBottom.php");
		    exit();
		} 
		else 
		{
				$error = $_FILES["userfile"]["error"];
		    print "파일 업로드 실패!\n$error\n";
		}
		
		echo '자세한 디버깅 정보입니다:';
		print_r($_FILES);

		print "</pre>";
		
	}
	else
	{
	    // echo("Please upload only audio files and lower then 20M files");
	    echo("<script>alert(\"Please upload only audio files and smaller file size than 20M\");
	    	window.location=\"/main/myProject/projectBottom.php\";
	    	</script>");
			// echo("<script>file_err();</script>");
	    // sleep(5);
	    //header("Location: /main/myProject/projectBottom.php");
	}


	// session_start();
	// $project_id = $_SESSION['project_id'];
	// $user_id = $_SESSION['user_id'];
	// $comment = $_REQUEST['comment'];
	// $sql = "Insert into sources (pri_user_id,created_at,project_id,COMMENT) values('$user_id',NOW(),'$project_id','$comment')";
	// $res = mysql_query($sql);

	// header("Location: /main/myProject/projectBottom.php");
?>
