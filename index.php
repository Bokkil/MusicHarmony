<?PHP
header('Content-Type: text/html; charset=utf-8');
session_cache_expire(1800);
session_start();
?>

<?PHP
$base_dir = "/home/mh/soma/webpage";

if(isset($_SESSION["user_id"]))
{
  include("$base_dir/main/layout.php");
  //echo ("세션 있음");
}
else {
  include("$base_dir/login/loginform.php");
  // echo ("세션 없음");
}
?>
