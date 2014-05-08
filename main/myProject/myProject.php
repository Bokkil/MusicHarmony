<?PHP
header('Content-Type: text/html; charset=utf-8');
session_cache_expire(1800);
session_start();
// session_unset();
?>
<script>
      var menu_group = $('#menu-btn-group');
      menu_group.removeClass('menu_mbp');
      menu_group.removeClass('menu_hcb');
      menu_group.removeClass('menu_none');
      menu_group.removeClass('menu_tlb');
      menu_group.addClass('menu_atb');
</script>
<?PHP
// $base_dir = "/home/mh/soma/webpage";
// include("$base_dir/include/config/config.php");
$db_host    = "localhost";
$db_user    = "mh";
$db_password  = "thak2014";
$db_dbname  = "mh";
$db_conn    = mysql_connect($db_host, $db_user, $db_password);
mysql_select_db($db_dbname, $db_conn);
$user_id=$_SESSION["user_id"];
// echo($user_id);
// $project_id=$_GET['a'];
$q="select * from projects where pri_user_id='$user_id';";
$sql_result=mysql_query($q, $db_conn);        
$count=mysql_num_rows($sql_result);
echo("<script>query_count=$count;</script>");

for($i=0; $i<$count; $i++)
{
  $pro_dbid[$i]=mysql_result($sql_result, $i, 'id');
  $pro_dbGOOD_COUNT[$i]=mysql_result($sql_result, $i, 'GOOD_COUNT');
  $pro_dbDOWNLOAD_COUNT[$i]=mysql_result($sql_result, $i, 'DOWNLOAD_COUNT');
  $pro_dbPLAY_COUNT[$i]=mysql_result($sql_result, $i, 'PLAY_COUNT');
  $pro_dbPLAY_TIME[$i]=mysql_result($sql_result, $i, 'PLAY_TIME');

  $pro_dbcreated_at[$i]=mysql_result($sql_result, $i, 'created_at');
  $pro_dbupdated_at[$i]=mysql_result($sql_result, $i, 'updated_at');
  $pro_dbALBUM_IMAGE_PATH[$i]=mysql_result($sql_result, $i, 'ALBUM_IMAGE_PATH');
  $pro_dbTITLE[$i]=mysql_result($sql_result, $i, 'TITLE');
  $pro_dbARTIST[$i]=mysql_result($sql_result, $i, 'ARTIST');

  $pro_dbPROJECT_INFO[$i]=mysql_result($sql_result, $i, 'PROJECT_INFO');
  $pro_dbmeta_num[$i]=mysql_result($sql_result, $i, 'meta_id');
  $pro_dbpri_user_id[$i]=mysql_result($sql_result, $i, 'pri_user_id');
  $pro_dbGENRE[$i]=mysql_result($sql_result, $i, 'GENRE');
}
echo("<script>var num=0;</script>");
for($i = 0 ; $i < $count; $i++){
  echo ("<script>
      var pro_dbid[num]='$pro_dbid[$i]';
      var pro_dbGOOD_COUNT[num]='$pro_dbGOOD_COUNT[$i]';
      var pro_dbDOWNLOAD_COUNT[num]='$pro_dbDOWNLOAD_COUNT[$i]';
      var pro_dbPLAY_COUNT[num]='$pro_dbPLAY_COUNT[$i]';
      var pro_dbPLAY_TIME[num]='$pro_dbPLAY_TIME[$i]';

      var pro_dbcreated_at[num]='$pro_dbcreated_at[$i]';
      var pro_dbupdated_at[num]='$pro_dbupdated_at[$i]';
      var pro_dbALBUM_IMAGE_PATH[num]='$pro_dbALBUM_IMAGE_PATH[$i]';
      var pro_dbTITLE[num]='$pro_dbTITLE[$i]';
      var pro_dbARTIST[num]='$pro_dbARTIST[$i]';

      var pro_dbPROJECT_INFO[num]='$pro_dbPROJECT_INFO[$i]';
      var pro_dbmeta_num[num]='$pro_dbmeta_num[$i]';
      var pro_dbpri_user_id[num]='$pro_dbpri_user_id[$i]';
      var pro_dbGENRE[num]='$pro_dbGENRE[$i]';
      </script>");
  echo("<script>num++;</script>");
}
?>
<div class="content-left-mp">
  <div class="bar-area">
    <img id="myProject-bar-img"></img>
  </div>

  <div class="bs-example normal col-md-6" id="project-list-area-myproject">
    <legend>Project List</legend>
    <div id="project-list-myproject">
      <?PHP 
      for($i=0; $i<$count; $i++){
        echo("
        <div class=\"projects\">
          <h3>$pro_dbTITLE[$i]</h3>
          <a>
            <img onclick=\"getAlbumInfo($pro_dbid[$i]);\" class=\"projcet-img\" src=\"/uploads/albumImg/$pro_dbALBUM_IMAGE_PATH[$i]\"/>
          </a>
          <h5>Info : $pro_dbPROJECT_INFO[$i]</h5>
          <div>
            <a class=\"btn btn-danger btn-xs pull-right\" role=\"button\" href=\"/project/$pro_dbid[$i]/destroy\">
              delete
            </a>
          </div>
        </div>
        <div class=\"center\">
          <img class=\"under-bar-line under-bar-line-shot\"></img>
        </div>
        "); 
      }
      ?>
    </div>
  </div>
  
</div>


<div id="create_project_frame_div" class="create_project_frame_div">
  <iframe src='/main/myProject/create-project_frame.php' id="create-project-frame" name='create-project-frame' width="360px" height="450px" scrolling=no frameBorder="0" style="position: fixed; top: 342px;"></iframe>
</div>

