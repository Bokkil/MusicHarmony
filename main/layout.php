<?PHP
// header('Content-Type: text/html; charset=utf-8');
// session_cache_expire(1800);
// session_start();
// session_unset();
// session_unset() => 현재 연결된 세션에 등록되어 있는 모둔 변수의 값을 삭제 
// session_destroy() =>현재의 세션을 종료 
// $_SESSION["user_id"]=4;
if(!$_SESSION['user_id'])
  header("Location: /");
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
  <div id="container" class="normal">
    <?PHP
      include("$base_dir/include/config/header.php");
    ?>
    <nav class="navbar-fixed-top" role="navigation">
      <div id="navbar-fixed-area">
        <div id="player-area" class="container middleArea">
        <?PHP
          include("$base_dir/main/player/music_player.php");
        ?>
        </div>
      </div>
    </nav>
    <div id="content" class="middleArea">
    <?PHP
      include("$base_dir/main/harmonyChart/harmonyChart.php");
    ?>
    </div>
  </div>
</body>
</html>
