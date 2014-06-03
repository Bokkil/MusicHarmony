<head>
  <?PHP 
    header('Content-Type: text/html; charset=utf-8');
    session_start();
    $base_dir = "/home/mh/soma/webpage";
    include("$base_dir/main/file_include.php");
  ?>
  <script src="/include/js/header.js"></script>
</head>
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
$project_id=$_GET['a'];
$_SESSION["project_id"] = $project_id;
$q="select projects.*, sounds.id as sound_id, sounds.project_id, sounds.pri_user_id as sound_pri_user_id, sounds.SOUND_PATH, sounds.updated_at as sound_updated_at from projects, sounds where projects.id=sounds.project_id and projects.id=$project_id;";
$sql_result=mysql_query($q, $db_conn); 
$count2=mysql_num_rows($sql_result);
      
if($count2){
  $pro_dbid=$project_id;
  $pro_dbGOOD_COUNT=mysql_result($sql_result, 0 , 'GOOD_COUNT');
  $pro_dbDOWNLOAD_COUNT=mysql_result($sql_result, 0 , 'DOWNLOAD_COUNT');
  $pro_dbPLAY_COUNT=mysql_result($sql_result, 0 , 'PLAY_COUNT');
  $pro_dbPLAY_TIME=mysql_result($sql_result, 0 , 'PLAY_TIME');

  (mysql_result($sql_result, 0 , 'created_at')!=null)?$pro_dbcreated_at=mysql_result($sql_result, 0 , 'created_at'):$pro_dbcreated_at=0;
  // $pro_dbcreated_at=mysql_result($sql_result, 0 , 'created_at');
  (mysql_result($sql_result, 0 , 'updated_at')!=null)?$pro_dbupdated_at=mysql_result($sql_result, 0 , 'updated_at'):$pro_dbupdated_at=0;
  // $pro_dbupdated_at=mysql_result($sql_result, 0 , 'updated_at');
  // (mysql_result($pro_dbALBUM_IMAGE_PATH, 0 , 'ALBUM_IMAGE_PATH')!=null)?$pro_dbALBUM_IMAGE_PATH=mysql_result($pro_dbALBUM_IMAGE_PATH, 0 , 'ALBUM_IMAGE_PATH'):$pro_dbALBUM_IMAGE_PATH="";
  $pro_dbALBUM_IMAGE_PATH=mysql_result($sql_result, 0 , 'ALBUM_IMAGE_PATH');
  $pro_dbTITLE=mysql_result($sql_result, 0 , 'TITLE');
  $pro_dbARTIST=mysql_result($sql_result, 0 , 'ARTIST');

  $pro_dbPROJECT_INFO=mysql_result($sql_result, 0 , 'PROJECT_INFO');
  echo("<script>
        var pro_INFO = '$pro_dbPROJECT_INFO';
  </script>");
  $pro_dbmeta_num=mysql_result($sql_result, 0 , 'meta_id');
  $pro_dbpri_user_id=mysql_result($sql_result, 0 , 'pri_user_id');
  $pro_dbGENRE=mysql_result($sql_result, 0 , 'GENRE');
  $pro_dbsound_id=mysql_result($sql_result, 0 , 'sound_id');

  $pro_dbsound_pri_user_id=mysql_result($sql_result, 0 , 'sound_pri_user_id');
  $pro_dbSOUND_PATH=mysql_result($sql_result, 0 , 'SOUND_PATH');
  $pro_dbsound_updated_at=mysql_result($sql_result, 0 , 'sound_updated_at');

  $sql = "select NAME from users where id=$pro_dbsound_pri_user_id;";
  $res2=mysql_query($sql,$db_conn);
  $pro_dbuploader_user_name = mysql_result($res2, 0,'NAME');
}
else{
  $q="select * from projects where id='$project_id';";
  $sql_result=mysql_query($q, $db_conn); 
  $count=mysql_num_rows($sql_result);

  $pro_dbid=$project_id;
  $pro_dbGOOD_COUNT=mysql_result($sql_result, 0 , 'GOOD_COUNT');
  $pro_dbDOWNLOAD_COUNT=mysql_result($sql_result, 0 , 'DOWNLOAD_COUNT');
  $pro_dbPLAY_COUNT=mysql_result($sql_result, 0 , 'PLAY_COUNT');
  $pro_dbPLAY_TIME=mysql_result($sql_result, 0 , 'PLAY_TIME');

  (mysql_result($sql_result, 0 , 'created_at')!=null)?$pro_dbcreated_at=mysql_result($sql_result, 0 , 'created_at'):$pro_dbcreated_at=0;
  $pro_dbsound_updated_at=mysql_result($sql_result, 0 , 'updated_at');
  $pro_dbALBUM_IMAGE_PATH=mysql_result($sql_result, 0 , 'ALBUM_IMAGE_PATH');
  $pro_dbTITLE=mysql_result($sql_result, 0 , 'TITLE');
  $pro_dbARTIST=mysql_result($sql_result, 0 , 'ARTIST');

  $pro_dbPROJECT_INFO=mysql_result($sql_result, 0 , 'PROJECT_INFO');
  echo("<script>
        var pro_INFO = '$pro_dbPROJECT_INFO';
  </script>");
  $pro_dbmeta_num=mysql_result($sql_result, 0 , 'meta_id');
  $pro_dbpri_user_id=mysql_result($sql_result, 0 , 'pri_user_id');
  $pro_dbGENRE=mysql_result($sql_result, 0 , 'GENRE');

  $sql2 = "select NAME from users where id=$pro_dbpri_user_id;";
  $res2=mysql_query($sql2,$db_conn);
  $pro_dbuploader_user_name = mysql_result($res2, 0,'NAME');
}
?>
<script>
$(document).ready(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader(); //파일을 읽기 위한 FileReader객체 생성
            reader.onload = function (e) { 
            //파일 읽어들이기를 성공했을때 호출되는 이벤트 핸들러
                $('#pro-img').attr('src', e.target.result);
                //이미지 Tag의 SRC속성에 읽어들인 File내용을 지정
                //(아래 코드에서 읽어들인 dataURL형식)
            }                    
            reader.readAsDataURL(input.files[0]);
            //File내용을 읽어 dataURL형식의 문자열로 저장
        }
    }//readURL()--

    //file 양식으로 이미지를 선택(값이 변경) 되었을때 처리하는 코드
    $("#inputProImg").change(function(){
        // alert(this.value); //선택한 이미지 경로 표시
        readURL(this);
    });
 });
</script>
<?php echo("<form class=\"form-horizontal\" role=\"form\" action=\"/main/myProject/my_pro_connect.php?a=".$pro_dbid."\" method=\"post\" enctype=\"multipart/form-data\">");?>
  <div class="row pi-main-row-top album-info-area">
    <div class="col-xs-5">
      <div class="pi-main-alblum-img-back-edit">
        <?php echo("<img id=\"pro-img\" class=\"pi-main-album-full-edit img-radius\" src=\"/uploads/albumImg/$pro_dbALBUM_IMAGE_PATH\">");?>
      </div>
      <input type="file" oninput="OnInput(event)" name="ALBUM_IMAGE_PATH" class="form-control" id="inputProImg" style="height: 30px;">
    </div>
    <div class="col-xs-7 pi-main-formgroup pi-main-formgroup-edit">
      <div class="form-group">
        <label class="col-xs-4 control-label">Title</label>
        <div class="col-xs-8">
            <?php echo("<input type=\"text\" name=\"TITLE\" class=\"form-control\" id=\"title\" value=\"$pro_dbTITLE\"style=\"height: 25px;\">");?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-xs-4 control-label">Creator</label>
        <?php echo("<div onclick=\"user_info($pro_dbpri_user_id);\" class=\"pointer col-xs-7\">$pro_dbARTIST</div>");?>
      </div>
      <div class="form-group">
        <label class="col-xs-4 control-label">Created At</label>
        <div class="col-xs-8"><?php echo($pro_dbcreated_at); ?></div>
      </div>
      <div class="form-group">
        <label class="col-xs-4 control-label">Genre</label>
        <div class="col-xs-8">
             <?php echo("<select type=\"text\" name=\"GENRE\" class=\"form-control\" id=\"genre\" style=\"height: 25px;\">
              <option>$pro_dbGENRE</option>
             ");?>
                <option>Rock</option>
                <option>Pop</option>
                <option>HipHop</option>
                <option>Electronic</option>
                <option>Jazz</option>
                <option>Blues</option>
                <option>RnB</option>
              </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-xs-4 control-label">Good Count</label>
        <div class="col-xs-8"><?php echo($pro_dbGOOD_COUNT); ?></div>
      </div>
      <div class="form-group" style="height: 32px;">
        <label class="col-xs-4 control-label">Musician</label>
        <?php
        if($count2){
          echo("<div onclick=\"user_info($pro_dbsound_pri_user_id);\" class=\"pointer col-xs-7\">$pro_dbuploader_user_name</div>");
        }
        else{
          echo("<div onclick=\"user_info($pro_dbpri_user_id);\" class=\"pointer col-xs-7\">$pro_dbuploader_user_name</div>");
        }
        ?>
      </div>
      <div class="form-group" style="height: 38px;">
        <label class="col-xs-4 control-label introduce-label" style="color: rgb(22, 39, 165);margin-left: 20px;width: 120px;"><a class="mic-icon"></a>Introduce</label>
        <div class="col-xs-8 project-info-text">
          <textarea id="pro-info-text" class="pro-info-text" name="INFO" style="padding-left: 12px;"><?php echo($pro_dbPROJECT_INFO);?></textarea>
        </div>
      </div>
    </div>
    <button type="submit" id="pro-edit-summit-btn" class="pro-edit-summit-btn right" role="button"></button>
  </div>
</form>