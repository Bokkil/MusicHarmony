<?PHP
// header('Content-Type: text/html; charset=utf-8');
// session_cache_expire(1800);
// session_start();
$db_host    = "localhost";
$db_user    = "mh";
$db_password  = "thak2014";
$db_dbname  = "mh";
$db_conn    = mysql_connect($db_host, $db_user, $db_password);
mysql_select_db($db_dbname, $db_conn);

$user_id=$_SESSION["user_id"];

$q_favorite_project="select * from projects, (select project_id as favorite_project_id from favorite where user_id='$user_id')x where projects.id=favorite_project_id;";
$q_favorite_project_result=mysql_query($q_favorite_project, $db_conn);  
$q_favoritelist_project_count=mysql_num_rows($q_favorite_project_result);
for($i=0; $i<$q_favoritelist_project_count; $i++)
{
  $favoritelist_pro_dbTITLE[$i]=mysql_result($q_favorite_project_result, $i, 'TITLE');
  $favoritelist_pro_dbARTIST[$i]=mysql_result($q_favorite_project_result, $i, 'ARTIST');
  $favoritelist_pro_dbproject_id[$i]=mysql_result($q_favorite_project_result, $i, 'favorite_project_id');
  $favoritelist_pro_dbpri_user_id[$i]=mysql_result($q_favorite_project_result, $i, 'pri_user_id');

  $q_favorite_project_r="select id, SOUND_PATH, pri_user_id from sounds where id='$favoritelist_pro_dbproject_id[$i]';";
  $q_favorite_project_result_r=mysql_query($q_favorite_project_r, $db_conn);
  $q_favorite_project_result_r_count=mysql_num_rows($q_favorite_project_result_r);

  if($q_favorite_project_result_r_count){
    $favoritelist_pro_dbsound_id[$i]=mysql_result($q_favorite_project_result_r, 0, 'id');
    $favoritelist_pro_dbSOUND_PATH[$i]=mysql_result($q_favorite_project_result_r, 0, 'SOUND_PATH');
  }
  else{
    $favoritelist_pro_dbsound_id[$i]=0;
    $favoritelist_pro_dbSOUND_PATH[$i]='Null';
    // $favoritelist_pro_dbpri_user_id[$i]=0;
  }
};

// $user_id=$_SESSION["user_id"];
// $q_favoritelist="select * from projects, (select sounds.id as sound_id, sounds.project_id, sounds.pri_user_id as sound_pri_user_id, sounds.SOUND_PATH, favorite.user_id from sounds, favorite where sounds.project_id=favorite.project_id and favorite.user_id='$user_id')x where projects.id=project_id;";
// $q_favoritelist_result=mysql_query($q_favoritelist, $db_conn);  
// $q_favoritelist_count=mysql_num_rows($q_favoritelist_result);
// for($i=0; $i<$q_favoritelist_count; $i++)
// {
//   $favoritelist_pro_dbTITLE[$i]=mysql_result($q_favoritelist_result, $i, 'TITLE');
//   $favoritelist_pro_dbARTIST[$i]=mysql_result($q_favoritelist_result, $i, 'ARTIST');
//   $favoritelist_pro_dbsound_id[$i]=mysql_result($q_favoritelist_result, $i, 'sound_id');
//   $favoritelist_pro_dbproject_id[$i]=mysql_result($q_favoritelist_result, $i, 'project_id');
//   $favoritelist_pro_dbSOUND_PATH[$i]=mysql_result($q_favoritelist_result, $i, 'SOUND_PATH');
//   $favoritelist_pro_dbpri_user_id[$i]=mysql_result($q_favoritelist_result, $i, 'pri_user_id');
// }
?>