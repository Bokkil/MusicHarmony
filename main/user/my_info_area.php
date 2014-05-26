<?PHP
header('Content-Type: text/html; charset=utf-8');
session_cache_expire(1800);
session_start();
// session_unset();
?>
<!DOCTYPE html>
<html>
<head>
  <?PHP 
    $base_dir = "/home/mh/soma/webpage";
    include("$base_dir/main/file_include.php");
  ?>
</head>

<body>
<script type="text/javascript">
function user_edit_mode(){
  $("#user-info-change-area").load("/main/user/my_info_edit.php");
}
</script>

<?PHP
$db_host    = "localhost";
$db_user    = "mh";
$db_password  = "thak2014";
$db_dbname  = "mh";
$db_conn    = mysql_connect($db_host, $db_user, $db_password);
mysql_select_db($db_dbname, $db_conn);

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
        var user_INFO = '$user_INFO';
  </script>");
?>
<div id="user-info-change-area">
  <img id="user-edit-btn" onclick="user_edit_mode();" class="user-edit-btn">
  <form class="form-horizontal" role="form">
    <div class="userinfo-row row">
      <div class="col-xs-5">
        <div class="user-img-back">
          <?php echo("
          <img class=\"user-album-full img-radius\" src=\"/uploads/userImg/$user_PICTURE\">
          "); ?>
        </div>
      </div>
      <div class="col-xs-7 user-info-formgroup user-info-margin-bottom">
        <div class="form-group">
          <label for="inputEmail3" class="col-xs-3 control-label">Nick Name</label>
          <div class="col-xs-9">
            <?php echo("$user_NAME");?>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-xs-3 control-label">Join Date</label>
          <div class="col-xs-9">
            <?php echo("$user_created_at");?>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-xs-3 control-label">E-Mail</label>
          <div class="col-xs-9">
            <?php echo("$user_EMAIL");?>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-xs-3 control-label">Part</label>
          <div class="col-xs-9">
            <?php echo("$user_PART");?>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-xs-3 control-label">Affiliate Band</label>
          <div class="col-xs-9">
            <?php echo("$user_AFFILIATE_BAND");?>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-xs-3 control-label">Introduce</label>
          <div class="col-xs-9">
            <?php echo("$user_INFO");?>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
</body>
</html>