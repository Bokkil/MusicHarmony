<?PHP
// 데이터베이스 연결 오브젝트 
$db_host		= "localhost";
$db_user		= "mh";
$db_password	= "thak2014";
$db_dbname  = "mh";
$db_conn    = mysql_connect($db_host, $db_user, $db_password);
mysql_select_db($db_dbname, $db_conn);
// 유저 아이디 저장 값, Cookie 로 저장할 것 
// $userId
?>
