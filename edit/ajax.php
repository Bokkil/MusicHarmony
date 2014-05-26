<?PHP
$db_host    = "localhost";
$db_user    = "mh";
$db_password  = "thak2014";
$db_dbname  = "mh";
$db_conn    = mysql_connect($db_host, $db_user, $db_password);
mysql_select_db($db_dbname, $db_conn);

$project_id=$_GET['project_id'];
echo($project_id);
$q="select * from sounds where project_id = $project_id;";
$sql_result=mysql_query($q, $db_conn); 
$count2=mysql_num_rows($sql_result);
$sound_file_path=mysql_result($sql_result, 0, 'SOUND_PATH');
echo($sound_file_path);
?>