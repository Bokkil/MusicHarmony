<?PHP
session_cache_expire(1800);
session_start();

$base_dir = "/home/mh/soma/webpage";
include("$base_dir/include/config/config.php");

extract($_POST);
$user_id=$_SESSION["user_id"];
$TITLE=$_POST["TITLE"];
$ARTIST=$_SESSION["user_NAME"];
$GENRE=$_POST["GENRE"];
// $ALBUM_IMAGE_PATH=$_POST["ALBUM_IMAGE_PATH"];
$ALBUM_IMAGE_PATH=$_FILES['ALBUM_IMAGE_PATH']['name'];
$PROJECT_INFO=$_POST["PROJECT_INFO"];

$q="INSERT INTO projects(
created_at,
updated_at,
ALBUM_IMAGE_PATH,
TITLE,
ARTIST,
PROJECT_INFO,
pri_user_id,
GENRE)
VALUES(now(),
now(),
'$ALBUM_IMAGE_PATH',
'$TITLE',
'$ARTIST',
'$PROJECT_INFO',
'$user_id',
'$GENRE');";

if ($_FILES['ALBUM_IMAGE_PATH']['error'] > 0) { 
    echo 'problem'; 
    switch ($_FILES['ALBUM_IMAGE_PATH']['error']) { 
        case 1: echo 'file exceeded upload_max_filesize'; break; 
        case 2: echo 'file exceeded max_file_size'; break; 
        case 3: echo 'file only partially uploaded'; break; 
        case 4: echo 'No file uploaded'; break; 
    } 
echo "<script>alert('프로젝트 생성에 실패했습니다.'); 
location.replace('/main/myProject/create-project_frame.php');</script>";
exit; 
} 
else{
    mysql_query($q, $db_conn);
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

echo '파일이 성공적으로 등록 되었습니다. <br /><br />'; 
$q_pi="select * from projects where pri_user_id=$user_id order by updated_at desc limit 1;";
$q_pi_go=mysql_query($q_pi, $db_conn);
$q_pi_project_id = mysql_result($q_pi_go, 0,'id');
// echo "<script>alert('파일이 성공적으로 등록 되었습니다.');location.href='./create-project_frame.php';</script>";
echo ("<script>alert('파일이 성공적으로 등록 되었습니다.'); 
parent.$(\"#content\").load(\"/main/myProject/projectInfo.php?a=\"+$q_pi_project_id);
 location.replace('/main/myProject/create-project_frame.php');</script>");
?>