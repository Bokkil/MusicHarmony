<?PHP
$base_dir = "/home/mh/soma/webpage";
include_once ("$base_dir/include/config/config.php");

// all
$q_all="select * from projects order by GOOD_COUNT DESC LIMIT 10;";
$q_all_result=mysql_query($q_all, $db_conn);          
$q_all_count=mysql_num_rows($q_all_result);
for($i=0; $i<$q_all_count; $i++)
{
  $all_pro_dbid[$i]=mysql_result($q_all_result, $i, 'id');
  $all_pro_dbALBUM_IMAGE_PATH[$i]=mysql_result($q_all_result, $i, 'ALBUM_IMAGE_PATH');
  $all_pro_dbTITLE[$i]=mysql_result($q_all_result, $i, 'TITLE');
  $all_pro_dbARTIST[$i]=mysql_result($q_all_result, $i, 'ARTIST');
  $all_pro_dbPROJECT_INFO[$i]=mysql_result($q_all_result, $i, 'PROJECT_INFO');
  $all_pro_dbpri_user_id[$i]=mysql_result($q_all_result, $i, 'pri_user_id');
}

// jazz
$q_jazz="select * from projects where GENRE='Jazz' order by GOOD_COUNT DESC LIMIT 5;";
$q_jazz_result=mysql_query($q_jazz, $db_conn);          
$q_jazz_count=mysql_num_rows($q_jazz_result);
for($i=0; $i<$q_jazz_count; $i++)
{
  $jazz_pro_dbid[$i]=mysql_result($q_jazz_result, $i, 'id');
  $jazz_pro_dbALBUM_IMAGE_PATH[$i]=mysql_result($q_jazz_result, $i, 'ALBUM_IMAGE_PATH');
  $jazz_pro_dbTITLE[$i]=mysql_result($q_jazz_result, $i, 'TITLE');
  $jazz_pro_dbARTIST[$i]=mysql_result($q_jazz_result, $i, 'ARTIST');
  $jazz_pro_dbPROJECT_INFO[$i]=mysql_result($q_jazz_result, $i, 'PROJECT_INFO');
  $jazz_pro_dbpri_user_id[$i]=mysql_result($q_jazz_result, $i, 'pri_user_id');
}

// blues
$q_blues="select * from projects where GENRE='Blues' order by GOOD_COUNT DESC LIMIT 5;";
$q_blues_result=mysql_query($q_blues, $db_conn);          
$q_blues_count=mysql_num_rows($q_blues_result);
for($i=0; $i<$q_blues_count; $i++)
{
  $blues_pro_dbid[$i]=mysql_result($q_blues_result, $i, 'id');
  $blues_pro_dbALBUM_IMAGE_PATH[$i]=mysql_result($q_blues_result, $i, 'ALBUM_IMAGE_PATH');
  $blues_pro_dbTITLE[$i]=mysql_result($q_blues_result, $i, 'TITLE');
  $blues_pro_dbARTIST[$i]=mysql_result($q_blues_result, $i, 'ARTIST');
  $blues_pro_dbPROJECT_INFO[$i]=mysql_result($q_blues_result, $i, 'PROJECT_INFO');
  $blues_pro_dbpri_user_id[$i]=mysql_result($q_blues_result, $i, 'pri_user_id');
}

// rnb
$q_rnb="select * from projects where GENRE='RnB' order by GOOD_COUNT DESC LIMIT 5;";
$q_rnb_result=mysql_query($q_rnb, $db_conn);          
$q_rnb_count=mysql_num_rows($q_rnb_result);
for($i=0; $i<$q_rnb_count; $i++)
{
  $rnb_pro_dbid[$i]=mysql_result($q_rnb_result, $i, 'id');
  $rnb_pro_dbALBUM_IMAGE_PATH[$i]=mysql_result($q_rnb_result, $i, 'ALBUM_IMAGE_PATH');
  $rnb_pro_dbTITLE[$i]=mysql_result($q_rnb_result, $i, 'TITLE');
  $rnb_pro_dbARTIST[$i]=mysql_result($q_rnb_result, $i, 'ARTIST');
  $rnb_pro_dbPROJECT_INFO[$i]=mysql_result($q_rnb_result, $i, 'PROJECT_INFO');
  $rnb_pro_dbpri_user_id[$i]=mysql_result($q_rnb_result, $i, 'pri_user_id');
}

// hiphop
$q_hiphop="select * from projects where GENRE='HipHop' order by GOOD_COUNT DESC LIMIT 5;";
$q_hiphop_result=mysql_query($q_hiphop, $db_conn);          
$q_hiphop_count=mysql_num_rows($q_hiphop_result);
for($i=0; $i<$q_hiphop_count; $i++)
{
  $hiphop_pro_dbid[$i]=mysql_result($q_hiphop_result, $i, 'id');
  $hiphop_pro_dbALBUM_IMAGE_PATH[$i]=mysql_result($q_hiphop_result, $i, 'ALBUM_IMAGE_PATH');
  $hiphop_pro_dbTITLE[$i]=mysql_result($q_hiphop_result, $i, 'TITLE');
  $hiphop_pro_dbARTIST[$i]=mysql_result($q_hiphop_result, $i, 'ARTIST');
  $hiphop_pro_dbPROJECT_INFO[$i]=mysql_result($q_hiphop_result, $i, 'PROJECT_INFO');
  $hiphop_pro_dbpri_user_id[$i]=mysql_result($q_hiphop_result, $i, 'pri_user_id');
}

// pop
$q_pop="select * from projects where GENRE='Pop' order by GOOD_COUNT DESC LIMIT 5;";
$q_pop_result=mysql_query($q_pop, $db_conn);          
$q_pop_count=mysql_num_rows($q_pop_result);
for($i=0; $i<$q_pop_count; $i++)
{
  $pop_pro_dbid[$i]=mysql_result($q_pop_result, $i, 'id');
  $pop_pro_dbALBUM_IMAGE_PATH[$i]=mysql_result($q_pop_result, $i, 'ALBUM_IMAGE_PATH');
  $pop_pro_dbTITLE[$i]=mysql_result($q_pop_result, $i, 'TITLE');
  $pop_pro_dbARTIST[$i]=mysql_result($q_pop_result, $i, 'ARTIST');
  $pop_pro_dbPROJECT_INFO[$i]=mysql_result($q_pop_result, $i, 'PROJECT_INFO');
  $pop_pro_dbpri_user_id[$i]=mysql_result($q_pop_result, $i, 'pri_user_id');
}

// rock
$q_rock="select * from projects where GENRE='Rock' order by GOOD_COUNT DESC LIMIT 5;";
$q_rock_result=mysql_query($q_rock, $db_conn);          
$q_rock_count=mysql_num_rows($q_rock_result);
for($i=0; $i<$q_rock_count; $i++)
{
  $rock_pro_dbid[$i]=mysql_result($q_rock_result, $i, 'id');
  $rock_pro_dbALBUM_IMAGE_PATH[$i]=mysql_result($q_rock_result, $i, 'ALBUM_IMAGE_PATH');
  $rock_pro_dbTITLE[$i]=mysql_result($q_rock_result, $i, 'TITLE');
  $rock_pro_dbARTIST[$i]=mysql_result($q_rock_result, $i, 'ARTIST');
  $rock_pro_dbPROJECT_INFO[$i]=mysql_result($q_rock_result, $i, 'PROJECT_INFO');
  $rock_pro_dbpri_user_id[$i]=mysql_result($q_rock_result, $i, 'pri_user_id');
}

// electronic
$q_electronic="select * from projects where GENRE='Electronic' order by GOOD_COUNT DESC LIMIT 5;";
$q_electronic_result=mysql_query($q_electronic, $db_conn);          
$q_electronic_count=mysql_num_rows($q_electronic_result);
for($i=0; $i<$q_electronic_count; $i++)
{
  $electronic_pro_dbid[$i]=mysql_result($q_electronic_result, $i, 'id');
  $electronic_pro_dbALBUM_IMAGE_PATH[$i]=mysql_result($q_electronic_result, $i, 'ALBUM_IMAGE_PATH');
  $electronic_pro_dbTITLE[$i]=mysql_result($q_electronic_result, $i, 'TITLE');
  $electronic_pro_dbARTIST[$i]=mysql_result($q_electronic_result, $i, 'ARTIST');
  $electronic_pro_dbPROJECT_INFO[$i]=mysql_result($q_electronic_result, $i, 'PROJECT_INFO');
  $electronic_pro_dbpri_user_id[$i]=mysql_result($q_electronic_result, $i, 'pri_user_id');
}
?>

