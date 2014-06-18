<?PHP
header('Content-Type: text/html; charset=utf-8');
session_cache_expire(1800);
session_start();
// session_unset();
?>
<?PHP
$base_dir = "/home/mh/soma/webpage";
include("$base_dir/include/config/config.php");
$user_id = $_SESSION["user_id"];

$q2="select * from projects where projects.pri_user_id=$user_id;";
$sql_result2=mysql_query($q2, $db_conn);          //질의(위 내용)를 수행하라.
$count2=mysql_num_rows($sql_result2);
for($i=0; $i<$count2; $i++)
{
  $relation_pro_dbid[$i]=mysql_result($sql_result2, $i, 'id');
  $relation_pro_dbALBUM_IMAGE_PATH[$i]=mysql_result($sql_result2, $i, 'ALBUM_IMAGE_PATH');
  $relation_pro_dbTITLE[$i]=mysql_result($sql_result2, $i, 'TITLE');
  $relation_pro_dbARTIST[$i]=mysql_result($sql_result2, $i, 'ARTIST');
  $relation_pro_dbPROJECT_INFO[$i]=mysql_result($sql_result2, $i, 'PROJECT_INFO');
  $relation_pro_dbpri_user_id[$i]=mysql_result($sql_result2, $i, 'pri_user_id');
}
?>
<div class="content-left">
  <div class="info-area-back">
  </div>
  <div class="user-info-area">
    <div class="bar-area">
      <legend class="user-infomation-title">My Infomation</legend>
    </div>
    <?php echo("<iframe src='/main/user/my_info_area.php?a=$user_id' class=\"myinfo-frame\" id=\"myinfo-frame\" name='create-project-frame' scrolling=no></iframe>");?>
  </div>
</div>

<div class="side-area-panel panel panel-default right">
  <!-- Default panel contents -->
  <div class="side-banner">
    <div class="userAlbumBanner-img"></div>
    <?php 
    for($i=0; $i<$count2; $i++){echo("
      <a>
        <img onclick=\"getAlbumInfo($relation_pro_dbid[$i]);\" class=\"user-album img-radius\" src=\"/uploads/albumImg/$relation_pro_dbALBUM_IMAGE_PATH[$i]\"/>
      </a>
      ");}?>
  </div>
</div>