<?PHP
//header('Content-Type: text/html; charset=utf-8');
session_cache_expire(1800);
//현재 페이지에만 임의로 1800을 줍니다.
session_start();
?>
<script>
      var menu_group = $('#menu-btn-group');
      menu_group.removeClass('menu_hcb');
      menu_group.removeClass('menu_atb');
      menu_group.removeClass('menu_mpb');
      menu_group.removeClass('menu_tlb');
      menu_group.addClass('menu_none');
</script>
<script type="text/javascript">
  var userId = "<?PHP echo $_SESSION["user_id"]; ?>";
  var search_key = document.getElementById("search-box").value;
  var count1=0;
  var count1_r=0;
  var count2=0;
  var count3=0;
  var count4=0;
  var count4_r=0;
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
$searchKey=$_GET['a'];
$count1_r=0;
$count4_r=0;
$q1="select projects.*, sounds.id as sound_id, sounds.pri_user_id as sound_upload_user_id, sounds.SOUND_PATH from projects, sounds where projects.TITLE LIKE '%$searchKey%' and projects.id=sounds.project_id;";
$sql_result1=mysql_query($q1, $db_conn);        
$count1=mysql_num_rows($sql_result1);
for($i=0; $i<$count1; $i++)
{
  $search_pro_dbid[$i]=mysql_result($sql_result1, $i, 'id');
  $search_pro_dbALBUM_IMAGE_PATH[$i]=mysql_result($sql_result1, $i, 'ALBUM_IMAGE_PATH');
  $search_pro_dbTITLE[$i]=mysql_result($sql_result1, $i, 'TITLE');
  $search_pro_dbARTIST[$i]=mysql_result($sql_result1, $i, 'ARTIST');
  $search_pro_dbPROJECT_INFO[$i]=mysql_result($sql_result1, $i, 'PROJECT_INFO');
  $search_pro_dbpri_user_id[$i]=mysql_result($sql_result1, $i, 'pri_user_id');
  $search_pro_dbsound_id[$i]=mysql_result($sql_result1, $i, 'sound_id');
  $search_pro_dbSOUND_PATH[$i]=mysql_result($sql_result1, $i, 'SOUND_PATH');
}
if($count1==0){
  $q1_r="select * from projects where projects.TITLE LIKE '%$searchKey%';";
  $sql_result1_r=mysql_query($q1_r, $db_conn);        
  $count1_r=mysql_num_rows($sql_result1_r);
  for($i=0; $i<$count1_r; $i++)
  {
    $search_pro_dbid[$i]=mysql_result($sql_result1_r, $i, 'id');
    $search_pro_dbALBUM_IMAGE_PATH[$i]=mysql_result($sql_result1_r, $i, 'ALBUM_IMAGE_PATH');
    $search_pro_dbTITLE[$i]=mysql_result($sql_result1_r, $i, 'TITLE');
    $search_pro_dbARTIST[$i]=mysql_result($sql_result1_r, $i, 'ARTIST');
    $search_pro_dbPROJECT_INFO[$i]=mysql_result($sql_result1_r, $i, 'PROJECT_INFO');
    $search_pro_dbpri_user_id[$i]=mysql_result($sql_result1_r, $i, 'pri_user_id');
  }
}

$q2="select projects.*, sounds.id as sound_id, sounds.pri_user_id as sound_upload_user_id, sounds.SOUND_PATH from projects, sounds where sounds.SOUND_PATH LIKE '%$searchKey%' and projects.id=sounds.project_id;";  
$sql_result2=mysql_query($q2, $db_conn);        
$count2=mysql_num_rows($sql_result2);
for($i=0; $i<$count2; $i++)
{
  $search_sound_dbid[$i]=mysql_result($sql_result2, $i, 'id');
  $search_sound_dbALBUM_IMAGE_PATH[$i]=mysql_result($sql_result2, $i, 'ALBUM_IMAGE_PATH');
  $search_sound_dbTITLE[$i]=mysql_result($sql_result2, $i, 'TITLE');
  $search_sound_dbARTIST[$i]=mysql_result($sql_result2, $i, 'ARTIST');
  $search_sound_dbPROJECT_INFO[$i]=mysql_result($sql_result2, $i, 'PROJECT_INFO');
  $search_sound_dbpri_user_id[$i]=mysql_result($sql_result2, $i, 'pri_user_id');
  $search_sound_dbsound_id[$i]=mysql_result($sql_result2, $i, 'sound_id');
  $search_sound_dbSOUND_PATH[$i]=mysql_result($sql_result2, $i, 'SOUND_PATH');
}

$q3="select projects.*, sources.id as sound_id, sources.pri_user_id as sound_upload_user_id, sources.SOURCES_PATH from projects, sources where sources.SOURCES_PATH LIKE '%$searchKey%' and projects.id=sources.project_id;";  
$sql_result3=mysql_query($q3, $db_conn);        
$count3=mysql_num_rows($sql_result3);
for($i=0; $i<$count3; $i++)
{
  $search_source_dbid[$i]=mysql_result($sql_result3, $i, 'id');
  $search_source_dbALBUM_IMAGE_PATH[$i]=mysql_result($sql_result3, $i, 'ALBUM_IMAGE_PATH');
  $search_source_dbTITLE[$i]=mysql_result($sql_result3, $i, 'TITLE');
  $search_source_dbARTIST[$i]=mysql_result($sql_result3, $i, 'ARTIST');
  $search_source_dbPROJECT_INFO[$i]=mysql_result($sql_result3, $i, 'PROJECT_INFO');
  $search_source_dbpri_user_id[$i]=mysql_result($sql_result3, $i, 'pri_user_id');
  $search_source_dbsound_id[$i]=mysql_result($sql_result3, $i, 'sound_id');
  $search_source_dbSOUND_PATH[$i]=mysql_result($sql_result3, $i, 'SOURCES_PATH');
}

$q4="select projects.*, sounds.id as sound_id, sounds.pri_user_id as sound_upload_user_id, sounds.SOUND_PATH from projects, sounds where projects.ARTIST LIKE '%$searchKey%' and projects.id=sounds.project_id;";  
$sql_result4=mysql_query($q4, $db_conn);
$count4=mysql_num_rows($sql_result4);      
for($i=0; $i<$count4; $i++)
{
  $search_artist_dbid[$i]=mysql_result($sql_result4, $i, 'id');
  $search_artist_dbALBUM_IMAGE_PATH[$i]=mysql_result($sql_result4, $i, 'ALBUM_IMAGE_PATH');
  $search_artist_dbTITLE[$i]=mysql_result($sql_result4, $i, 'TITLE');
  $search_artist_dbARTIST[$i]=mysql_result($sql_result4, $i, 'ARTIST');
  $search_artist_dbPROJECT_INFO[$i]=mysql_result($sql_result4, $i, 'PROJECT_INFO');
  $search_artist_dbpri_user_id[$i]=mysql_result($sql_result4, $i, 'pri_user_id');
  $search_artist_dbsound_id[$i]=mysql_result($sql_result4, $i, 'sound_id');
  $search_artist_dbSOUND_PATH[$i]=mysql_result($sql_result4, $i, 'SOUND_PATH');
}
if($count4==0){
  $q4_r="select * from projects where projects.ARTIST LIKE '%$searchKey%';";
  $sql_result4_r=mysql_query($q4_r, $db_conn);        
  $count4_r=mysql_num_rows($sql_result4_r);
  for($i=0; $i<$count4_r; $i++)
  {
  $search_artist_dbid[$i]=mysql_result($sql_result4_r, $i, 'id');
  $search_artist_dbALBUM_IMAGE_PATH[$i]=mysql_result($sql_result4_r, $i, 'ALBUM_IMAGE_PATH');
  $search_artist_dbTITLE[$i]=mysql_result($sql_result4_r, $i, 'TITLE');
  $search_artist_dbARTIST[$i]=mysql_result($sql_result4_r, $i, 'ARTIST');
  $search_artist_dbPROJECT_INFO[$i]=mysql_result($sql_result4_r, $i, 'PROJECT_INFO');
  $search_artist_dbpri_user_id[$i]=mysql_result($sql_result4_r, $i, 'pri_user_id');
  }
}
echo ("<script>count1='$count1';</script>");
echo ("<script>count1_r='$count1_r';</script>");
echo ("<script>count2='$count2';</script>");
echo ("<script>count3='$count3';</script>");
echo ("<script>count4='$count4';</script>");
echo ("<script>count4_r='$count4_r';</script>");
?>
<script>
if(count1==0 && count1_r==0){
 var mes= "<h4 class='search-table-tr'>No results were found for your search in projects.</h4>";
 document.getElementById("search-table-project").innerHTML=mes;
 }
 if(count2==0 && count3==0){
 var mes= "<h4 class='search-table-tr'>No results were found for your search in tracks.</h4>";
 document.getElementById("search-table-track").innerHTML=mes;
 }
 if(count4==0 && count4_r==0){
 var mes= "<h4 class='search-table-tr'>No results were found for your search in users.</h4>";
 document.getElementById("search-table-artist").innerHTML=mes;
 }
</script>
