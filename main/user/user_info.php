<?PHP
header('Content-Type: text/html; charset=utf-8');
session_cache_expire(1800);
session_start();
// session_unset();
?>
<script type="text/javascript">
  var user_id = "<?PHP echo $_SESSION["user_id"]; ?>";
  var select_user_id = "<?PHP echo ($select_user_id); ?>";

  var select_user_NAME;
  var select_user_EMAIL;
  var select_user_PART;
  var select_user_AFFILIATE_BAND;
  var select_user_PICTURE;

  var select_user_created_at;
  var select_user_updated_at;
  var select_user_INFO;

  var query_count=0;
</script>

<?PHP
$db_host    = "localhost";
$db_user    = "mh";
$db_password  = "thak2014";
$db_dbname  = "mh";
$db_conn    = mysql_connect($db_host, $db_user, $db_password);
mysql_select_db($db_dbname, $db_conn);

// $base_dir = "/home/mh/soma/webpage";
// include("$base_dir/include/config/config.php");


$user_id=$_SESSION["user_id"];
$select_user_id=$_GET['a'];
$q="select * from users where id=$select_user_id";
$sql_result=mysql_query($q, $db_conn);          //질의(위 내용)를 수행하라.
$count=mysql_num_rows($sql_result);
echo("<script>query_count=$count;</script>");

$select_user_NAME=mysql_result($sql_result, 0 , 'NAME');
$select_user_EMAIL=mysql_result($sql_result, 0 , 'EMAIL');
$select_user_PART=mysql_result($sql_result, 0 , 'PART');
$select_user_AFFILIATE_BAND=mysql_result($sql_result, 0 , 'AFFILIATE_BAND');
$select_user_PICTURE=mysql_result($sql_result, 0 , 'PICTURE');

$select_user_created_at=mysql_result($sql_result, 0 , 'created_at');
$select_user_updated_at=mysql_result($sql_result, 0 , 'updated_at');
$select_user_INFO=mysql_result($sql_result, 0 , 'INFO');

echo("<script>
          select_user_NAME = '$select_user_NAME';
          select_user_EMAIL = '$select_user_EMAIL';
          select_user_PART = '$select_user_PART';
          select_user_AFFILIATE_BAND = '$select_user_AFFILIATE_BAND';
          select_user_PICTURE = '$select_user_PICTURE';

          select_user_created_at = '$select_user_created_at';
          select_user_updated_at = '$select_user_updated_at';
          select_user_INFO = '$select_user_INFO';
       </script>");

// $q2="select projects.*, sounds.id as sound_id, sounds.pri_user_id as sound_upload_user_id, sounds.SOUND_PATH from projects, sounds where projects.pri_user_id=$select_user_id and projects.id=sounds.project_id;";
$q2="select * from projects where projects.pri_user_id=$select_user_id;";
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
  // $relation_pro_dbsound_id[$i]=mysql_result($sql_result2, $i, 'sound_id');
  // $relation_pro_dbSOUND_PATH[$i]=mysql_result($sql_result2, $i, 'SOUND_PATH');
}
?>

<div class="content-left">
  <div class="info-area-back">
  </div>
  <div class="user-info-area">
    <div class="bar-area">
      <legend class="user-infomation-title">User Infomation</legend>
    </div>
    <form class="form-horizontal" role="form">
      <div class="row">
        <div class="col-md-5">
          <div class="user-img-back">
            <?php echo("
            <img class=\"user-album-full img-radius\" src=\"/uploads/userImg/$select_user_PICTURE\">
            "); ?>
          </div>
        </div>
        <div class="col-md-7 user-info-formgroup user-info-margin-bottom">
          <div class="form-group">
            <label for="inputEmail3" class="col-md-3 control-label">Nick Name</label>
            <div class="col-md-9">
              <?php echo("$select_user_NAME");?>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-md-3 control-label">Join Date</label>
            <div class="col-md-9">
              <?php echo("$select_user_created_at");?>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-md-3 control-label">E-Mail</label>
            <div class="col-md-9">
              <?php echo("$select_user_EMAIL");?>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-md-3 control-label">Part</label>
            <div class="col-md-9">
              <?php echo("$select_user_PART");?>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-md-3 control-label">Affiliate Band</label>
            <div class="col-md-9">
              <?php echo("$select_user_AFFILIATE_BAND");?>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-md-3 control-label">Introduce</label>
            <div class="col-md-9">
              <?php echo("$select_user_INFO");?>
            </div>
          </div>
        </div>
      </div>
    </form>
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