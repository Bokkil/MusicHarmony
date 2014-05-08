<?PHP
header('Content-Type: text/html; charset=utf-8');
session_cache_expire(1800);
session_start();
// session_unset();
?>
<?PHP
$base_dir = "/home/mh/soma/webpage";
include("$base_dir/main/artistRanking/artistRanking-connect.php");
?>

<div class="content-left">
  <div class="bar-area">
    <img id="artist-ranking-bar-img"></img>
  </div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#all" data-toggle="tab">All</a></li>
    <li><a href="#jazz" data-toggle="tab">Jazz</a></li>
    <li><a href="#blues" data-toggle="tab">Blues</a></li>
    <li><a href="#rnb" data-toggle="tab">R & B</a></li>
    <li><a href="#hiphop" data-toggle="tab">Hip Hop</a></li>
    <li><a href="#pop" data-toggle="tab">Pop</a></li>
    <li><a href="#rock" data-toggle="tab">Rock</a></li>
    <li><a href="#electronic" data-toggle="tab">Electronic</a></li>
  </ul>

  <div class="tab-content">

    <div class="tab-pane fade in active" id="all">
      <?php include("$base_dir/main/artistRanking/artistRanking-all.php"); ?>
    </div>

    <div class="tab-pane fade" id="jazz">
      <?php include("$base_dir/main/artistRanking/artistRanking-jazz.php"); ?>
    </div>

    <div class="tab-pane fade" id="blues">
      <?php include("$base_dir/main/artistRanking/artistRanking-blues.php"); ?>
    </div>

    <div class="tab-pane fade" id="rnb">
      <?php include("$base_dir/main/artistRanking/artistRanking-rnb.php"); ?>
    </div>

    <div class="tab-pane fade" id="hiphop">
      <?php include("$base_dir/main/artistRanking/artistRanking-hiphop.php"); ?>
    </div>

    <div class="tab-pane fade" id="pop">
      <?php include("$base_dir/main/artistRanking/artistRanking-pop.php"); ?>
    </div>

    <div class="tab-pane fade" id="rock">
      <?php include("$base_dir/main/artistRanking/artistRanking-rock.php"); ?>
    </div>

    <div class="tab-pane fade" id="electronic">
      <?php include("$base_dir/main/artistRanking/artistRanking-electronic.php"); ?>
    </div>

  </div>
</div>

<div class="my-play-list-area">
  <div class="my-play-list">
      aaaaaaaaaa
  </div>
</div>