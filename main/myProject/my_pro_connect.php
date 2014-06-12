<?PHP
session_cache_expire(1800);
session_start();

$db_host    = "localhost";
$db_user    = "mh";
$db_password  = "thak2014";
$db_dbname  = "mh";
$db_conn    = mysql_connect($db_host, $db_user, $db_password);
mysql_select_db($db_dbname, $db_conn);


extract($_POST);
$user_id=$_SESSION["user_id"];
$project_id=$_GET['a'];
$TITLE=$_POST["TITLE"];
$GENRE=$_POST["GENRE"];
// $AFFILIATE_BAND=$_POST["AFFILIATE"];
$INFO=$_POST["INFO"];
// $ALBUM_IMAGE_PATH=$_POST["ALBUM_IMAGE_PATH"];
$PICTURE=$_FILES['ALBUM_IMAGE_PATH']['name'];
?>

<?php
if($PICTURE){
// $q1="update users set NAME='$NAME', PART='$PART', AFFILIATE_BAND='$AFFILIATE_BAND', INFO='$INFO', PICTURE='$PICTURE' where id=$user_id;";
$q1="update projects set TITLE='$TITLE', GENRE='$GENRE', PROJECT_INFO='$INFO', ALBUM_IMAGE_PATH='$PICTURE' where id='$project_id';";
$sql_result1=mysql_query($q1, $db_conn);          //질의(위 내용)를 수행하라.

  if ($_FILES['ALBUM_IMAGE_PATH']['error'] > 0) { 
      echo 'problem'; 
      switch ($_FILES['ALBUM_IMAGE_PATH']['error']) { 
          case 1: echo 'file exceeded upload_max_filesize'; echo "<script>alert('file exceeded upload_max_filesize !!');</script>";break; 
          case 2: echo 'file exceeded max_file_size'; echo "<script>alert('file exceeded max_file_size !!');</script>";break; 
          case 3: echo 'file only partially uploaded'; echo "<script>alert('file only partially uploaded !!');</script>";break; 
          case 4: echo 'No file uploaded'; echo "<script>alert('No file uploaded !!');</script>";break; 
      } 
  echo "<script>location.replace('/main/myProject/myProject_edit.php?a=pro_id');</script>";
  exit; 
  } 

  //파일을 원하는 곳으로 옮긴다.
  $base_dir = "/home/mh/soma/webpage/uploads/albumImg/";
  $upfile = $base_dir.$_FILES['ALBUM_IMAGE_PATH']['name']; 
  // $dest = $save_dir . $_FILES["myFile"]["name"];
  $upfile_name = $_FILES['ALBUM_IMAGE_PATH']['name'];

  if (is_uploaded_file($_FILES['ALBUM_IMAGE_PATH']['tmp_name'])) { 
      
      // do { 
      //     $real_name = date("YmdHis") . "." . $ext; 
      // } while(file_exists("$base_dir/uploads/{$real_name}")); 


      if (!move_uploaded_file($_FILES['ALBUM_IMAGE_PATH']['tmp_name'], $upfile)) { 
      echo 'problem could not move file to destination directory';
      exit; 
      } 

  } else { 
      echo 'problem possible file upload attack. filename:'; 
      echo $_FILES['ALBUM_IMAGE_PATH']['name']; 
      exit; 
  } 
}
else{
  $q2="update projects set TITLE='$TITLE', GENRE='$GENRE', PROJECT_INFO='$INFO' where id='$project_id';";
  $sql_result2=mysql_query($q2, $db_conn);          //질의(위 내용)를 수행하라.
}

echo "<script>alert('Modify Complete !!'); parent.$(\"#content\").load(\"/main/myProject/projectInfo.php?a=\"+$project_id);</script>";
?>