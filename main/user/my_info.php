<?PHP
header('Content-Type: text/html; charset=utf-8');
session_cache_expire(1800);
session_start();
// session_unset();
?>

<script type="text/javascript">
  var user_id = "<?PHP echo $_SESSION["user_id"]; ?>";

  var user_NAME;
  var user_EMAIL;
  var user_PART;
  var user_AFFILIATE_BAND;
  var user_PICTURE;

  var user_created_at;
  var user_updated_at;
  var user_INFO;

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


$user_id = $_SESSION["user_id"];
$q="select * from users where id=$user_id";
$sql_result=mysql_query($q, $db_conn);          //질의(위 내용)를 수행하라.
$count=mysql_num_rows($sql_result);
echo("<script>query_count=$count;</script>");

$user_NAME=mysql_result($sql_result, 0 , 'NAME');
$user_EMAIL=mysql_result($sql_result, 0 , 'EMAIL');
$user_PART=mysql_result($sql_result, 0 , 'PART');
$user_AFFILIATE_BAND=mysql_result($sql_result, 0 , 'AFFILIATE_BAND');
$user_PICTURE=mysql_result($sql_result, 0 , 'PICTURE');

$user_created_at=mysql_result($sql_result, 0 , 'created_at');
$user_updated_at=mysql_result($sql_result, 0 , 'updated_at');
$user_INFO=mysql_result($sql_result, 0 , 'INFO');

echo("<script>
          user_NAME = '$user_NAME';
          user_EMAIL = '$user_EMAIL';
          user_PART = '$user_PART';
          user_AFFILIATE_BAND = '$user_AFFILIATE_BAND';
          user_PICTURE = '$user_PICTURE';

          user_created_at = '$user_created_at';
          user_updated_at = '$user_updated_at';
          user_INFO = '$user_INFO';
       </script>");
?>
<div class="bar-area">
  <img id="userInfo-bar-img"></img>
</div>

<div>
  <div class="bs-example">
    <legend>My Infomation</legend>
    <div id="project-comments">
      <div class="col-md-12">
      </div>
  </div>
</div>

<h3>닉네임 :<?PHP echo($user_NAME);?></h3>
<h3>이메일 :<?PHP echo($user_EMAIL);?></h3>
<h3>파트 :<?PHP echo($user_PART);?></h3>
<h3>소속 :<?PHP echo($user_AFFILIATE_BAND);?></h3>
<h3>사진 :<?PHP echo($user_PICTURE);?></h3>
<h3>가입날짜 :<?PHP echo($user_created_at);?></h3>
<h3>소개 :<?PHP echo($user_INFO);?></h3>
