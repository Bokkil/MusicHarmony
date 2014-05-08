<?PHP
header('Content-Type: text/html; charset=utf-8');
session_cache_expire(1800);
session_start();
// session_unset();
// session_unset($_SESSION["user_id"]);
// session_destroy($_SESSION["user_id"]);
// session_unset() => 현재 연결된 세션에 등록되어 있는 모둔 변수의 값을 삭제 
// session_destroy() =>현재의 세션을 종료 
// $_SESSION["user_id"]=4;
// echo($_SESSION["user_id"]);
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
