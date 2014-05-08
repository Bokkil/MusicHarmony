<?PHP
header('Content-Type: text/html; charset=utf-8');
session_start();
?>
<script>
  function ResizeFrame(name)

  {
    var fBody  = document.frames(name).document.body;
    var fName  = document.all(name);
    fName.style.width = fBody.scrollWidth + (fBody.offsetWidth - fBody.clientWidth);
    fName.style.height = fBody.scrollHeight + (fBody.offsetHeight - fBody.clientHeight);

    if (Frame_name.style.height == "0px" || Frame_name.style.width == "0px")

    {
      fName.style.width = "100%";
      fName.style.height = "300px";
    }
  }

<?PHP
$base_dir = "/home/mh/soma/webpage";
include("$base_dir/include/config/config.php");

$user_id=$_SESSION["user_id"];
$project_id=$_GET['a'];
$_SESSION["project_id"] = $project_id;
$q="select * from projects where id='$project_id';";
$sql_result=mysql_query($q, $db_conn);        
$count=mysql_num_rows($sql_result);

echo("<script>query_count=$count;</script>");
$pro_dbid=$project_id;
$pro_dbGOOD_COUNT=mysql_result($sql_result, 0 , 'GOOD_COUNT');
$pro_dbDOWNLOAD_COUNT=mysql_result($sql_result, 0 , 'DOWNLOAD_COUNT');
$pro_dbPLAY_COUNT=mysql_result($sql_result, 0 , 'PLAY_COUNT');
$pro_dbPLAY_TIME=mysql_result($sql_result, 0 , 'PLAY_TIME');

$pro_dbcreated_at=mysql_result($sql_result, 0 , 'created_at');
$pro_dbupdated_at=mysql_result($sql_result, 0 , 'updated_at');
$pro_dbALBUM_IMAGE_PATH=mysql_result($sql_result, 0 , 'ALBUM_IMAGE_PATH');
$pro_dbTITLE=mysql_result($sql_result, 0 , 'TITLE');
$pro_dbARTIST=mysql_result($sql_result, 0 , 'ARTIST');

$pro_dbPROJECT_INFO=mysql_result($sql_result, 0 , 'PROJECT_INFO');
$pro_dbmeta_num=mysql_result($sql_result, 0 , 'meta_id');
$pro_dbpri_user_id=mysql_result($sql_result, 0 , 'pri_user_id');
$pro_dbGENRE=mysql_result($sql_result, 0 , 'GENRE');
echo("<script>
          var pro_dbid = '$pro_dbid';
          var pro_dbGOOD_COUNT = '$pro_dbGOOD_COUNT';
          var pro_dbDOWNLOAD_COUNT = '$pro_dbDOWNLOAD_COUNT';
          var pro_dbPLAY_COUNT = '$pro_dbPLAY_COUNT';
          var pro_dbPLAY_TIME = '$pro_dbPLAY_TIME';

          var pro_dbcreated_at = '$pro_dbcreated_at';
          var pro_dbupdated_at = '$pro_dbupdated_at';
          var pro_dbALBUM_IMAGE_PATH = '$pro_dbALBUM_IMAGE_PATH';
          var pro_dbTITLE = '$pro_dbTITLE';
          var pro_dbARTIST = '$pro_dbARTIST';

          var pro_dbPROJECT_INFO = '$pro_dbPROJECT_INFO';
          var pro_dbmeta_num = '$pro_dbmeta_num';
          var pro_dbpri_user_id = '$pro_dbpri_user_id';
          var pro_dbGENRE = '$pro_dbGENRE';
       </script>");
?>

<div class="bar-area">
  <img id="projectInfo-bar-img"></img>
</div>

<div class="bs-example" id="projectInfo-area">
  <legend>Project Information</legend>
  <legend> 
    <p class="projectinfo-name">Project Name : <?php echo("$pro_dbTITLE");?> </p> 
    <p>Introduce : <?php echo("$pro_dbPROJECT_INFO");?></p>
  </legend>
  <div style="height: 150px;">
    <div class="pull-left col-md-2">
      <?php echo("<img width=\"180\" height=\"180\" src=\"/uploads/albumImg/$pro_dbALBUM_IMAGE_PATH\"/>"); ?>
    </div>
    <div class="projectinfo-postion col-md-2">
      <br>
      <div>
        <label>Upload : </label><?php echo("$pro_dbcreated_at");?>
      </div>
      <div>
        <label>Genre : </label><?php echo("$pro_dbGENRE");?>
      </div>
      <div>
        <label>Play Count : </label><?php echo("$pro_dbPLAY_COUNT");?>
      </div>
      <div>
        <label>Good Count : </label><?php echo("$pro_dbGOOD_COUNT");?>
      </div>
      <div>  
      <form>
        <?php echo("<button onclick=\"callEditProject($pro_dbid);\" type=\"button\" id=\"project-edit-button\" class=\"btn-default projectinfo-button\">Edit</button>"); ?>
        <button type="button" id="project-play-button" class="btn-default projectinfo-button">Play</button>
        <button type="button" id="project-download-button" class="btn-default projectinfo-button">DownLoad</button>
      </form>
      <div>
        <button type="button" id="project-join-button" class="btn-default projectinfo-button">Join the Project</button>
      </div>
      </div>
    </div>
  </div>

  <div class="center">
    <img class="under-bar-line under-bar-line-shot"></img>
  </div>
</div>

<iframe name="projectBottom" scrolling="No" onLoad="ResizeFrame('projectBottom');" class="col-md-12" src="/main/myProject/projectBottom.php" frameborder="0"></iframe>


