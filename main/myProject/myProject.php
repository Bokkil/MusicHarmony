<script>
var menu_group = $('#menu-btn-group');
menu_group.removeClass('menu_mbp');
menu_group.removeClass('menu_hcb');
menu_group.removeClass('menu_none');
menu_group.removeClass('menu_tlb');
menu_group.addClass('menu_atb');
</script>
<?PHP
header('Content-Type: text/html; charset=utf-8');
session_cache_expire(1800);
session_start();
// session_unset();
$db_host    = "localhost";
$db_user    = "mh";
$db_password  = "thak2014";
$db_dbname  = "mh";
$db_conn    = mysql_connect($db_host, $db_user, $db_password);
mysql_select_db($db_dbname, $db_conn);
$user_id=$_SESSION["user_id"];
function icone_text($flag)
{
  if($flag == 0)
  {
    return "<a type=\"button\" class=\"timeline-button timeline-comment-button\"></a>";
  }
  else if($flag == 1)
  {
    return "<a type=\"button\" class=\"timeline-button timeline-like-button\"></a>";
  }
  else if($flag == 2)
  {
    return "<a type=\"button\" class=\"timeline-button rank-download-button\"></a>";
  }
  else if($flag == 3)
  {
    return "<a type=\"button\" class=\"timeline-button rank-download-button\"></a>";
  }
  else if($flag == 4)
  {
    return "<a type=\"button\" class=\"timeline-button timeline-newtrack-button\"></a>";
  }
}
?>
<?PHP
$q="select * from projects where pri_user_id=$user_id;";
$sql_result=mysql_query($q, $db_conn);        
$count=mysql_num_rows($sql_result);
for($i=0; $i<$count; $i++)
{
  $pro_dbid[$i]=mysql_result($sql_result, $i, 'id');
  $pro_dbGOOD_COUNT[$i]=mysql_result($sql_result, $i, 'GOOD_COUNT');
  $pro_dbDOWNLOAD_COUNT[$i]=mysql_result($sql_result, $i, 'DOWNLOAD_COUNT');
  $pro_dbPLAY_COUNT[$i]=mysql_result($sql_result, $i, 'PLAY_COUNT');
  $pro_dbPLAY_TIME[$i]=mysql_result($sql_result, $i, 'PLAY_TIME');

  $pro_dbcreated_at[$i]=mysql_result($sql_result, $i, 'created_at');
  $pro_dbcreated_at_head[$i]=substr($pro_dbcreated_at[$i], 0,10);
  $pro_dbupdated_at[$i]=mysql_result($sql_result, $i, 'updated_at');
  $pro_dbupdated_at_head[$i]=substr($pro_dbupdated_at[$i], 0,10);
  $pro_dbALBUM_IMAGE_PATH[$i]=mysql_result($sql_result, $i, 'ALBUM_IMAGE_PATH');
  $pro_dbTITLE[$i]=mysql_result($sql_result, $i, 'TITLE');
  $pro_dbARTIST[$i]=mysql_result($sql_result, $i, 'ARTIST');

  $pro_dbPROJECT_INFO[$i]=mysql_result($sql_result, $i, 'PROJECT_INFO');
  $pro_dbmeta_num[$i]=mysql_result($sql_result, $i, 'meta_id');
  $pro_dbpri_user_id[$i]=mysql_result($sql_result, $i, 'pri_user_id');
  $pro_dbGENRE[$i]=mysql_result($sql_result, $i, 'GENRE');
}
?>
<div class="content-left-mp">
  <div class="bar-area">
    <img id="myProject-bar-img"></img>
  </div>

  <div class="panel-group" id="accordion">
    <?php
    if($count != 0)
    {
    $i=0;
    echo("
      <div class=\"panel panel-default mp-panel\">
      <div class=\"panel-heading pi-panel-heading\">
      <h4 class=\"panel-title\">
      <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#$i\">
      <img onclick=\"getAlbumInfo($pro_dbid[$i]);\" class=\"img-radius projcet-img\" src=\"/uploads/albumImg/$pro_dbALBUM_IMAGE_PATH[$i]\"/>
      <div class=\"mp-date-area right col-md-4\">
      <div>created date : $pro_dbcreated_at_head[$i]</div>
      <div>recent update : $pro_dbupdated_at_head[$i]</div>
      </div>
      <div class=\"mp-title-area right col-md-6\">
      <div class=\"mp-title\"><h4>$pro_dbTITLE[$i]</h4></div>
      <div class=\"mp-info\">$pro_dbPROJECT_INFO[$i]</div>
      </div>
      </a>
      </h4>
      </div>
      <div id=\"$i\" class=\"panel-collapse collapse\">
      <div class=\"panel-body\">
      ");
//    $sql = "select * from comments where pri_user_id=$user_id or project_id=$pro_dbid[$i] order by created_at desc;";
    $sql = "select * from comments where project_id=$pro_dbid[$i] order by created_at desc;";
    $res = mysql_query($sql);
    $cnt=mysql_num_rows($res);
    for($j=0;$j<$cnt;$j++)
    {
      $content = mysql_result($res,$j,'CONTENTS');
      $time = mysql_result($res,$j,'created_at');
      $commenter_id = mysql_result($res,$j, 'pri_user_id');
      $head_time = substr($time, 0,10);
      $type = mysql_result($res,$j,'TYPE');
      $project_id = mysql_result($res,$j,'project_id');
      $icone = icone_text($type);

      $sql2 = "select PICTURE, NAME, id from users where id = $commenter_id;";
      $res2 = mysql_query($sql2);

      $picture_path = mysql_result($res2,0,'PICTURE');
      $user_name = mysql_result($res2,0,'NAME');
      $comment_user_id = mysql_result($res2,0,'id');

      $temp_comment="";
      if($type==0){
        $q_temp = "select TITLE from projects where id=$project_id;";
        $res_temp = mysql_query($q_temp);
        $project_name = mysql_result($res_temp, 0);
        $temp_comment=$content;
        $content="$user_name"."님이 "."$project_name"."에 댓글을 남겼습니다.";
      }
      echo("  
       <div class=\"form-group\">
       <img onclick=\"user_info($comment_user_id);\" class=\"timeline-user-img left\" src=\"/uploads/userImg/$picture_path\"/>
       <div class=\"col-md-6\">
       <h4 onclick=\"user_info($comment_user_id);\" class=\"time-line-user-name\">$user_name</h4>
       <label class=\"time-line-label\" onclick=\"getAlbumInfo($project_id);\">
       $icone
       $content
       </label>
       <div>
       $temp_comment
       </div>
       </div>

       <div class=\"right time-line-date\">
       $time
       </div>
       </div>
       ");
    }
    echo("
      </div>
      </div>
      </div>
      ");
    for($i=1; $i<$count; $i++){
      echo("
        <div class=\"panel panel-default mp-panel\">
        <div class=\"panel-heading pi-panel-heading\">
        <h4 class=\"panel-title\">
        <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#$i\">
        <img onclick=\"getAlbumInfo($pro_dbid[$i]);\" class=\"img-radius projcet-img\" src=\"/uploads/albumImg/$pro_dbALBUM_IMAGE_PATH[$i]\"/>
        <div class=\"mp-date-area right col-md-4\">
        <div>created date : $pro_dbcreated_at_head[$i]</div>
        <div>recent update : $pro_dbupdated_at_head[$i]</div>
        </div>
        <div class=\"mp-title-area right col-md-6\">
        <div class=\"mp-title\"><h4>$pro_dbTITLE[$i]</h4></div>
        <div class=\"mp-info\">$pro_dbPROJECT_INFO[$i]</div>
        </div>
        </a>
        </h4>
        </div>
        <div id=\"$i\" class=\"panel-collapse collapse\">
        <div class=\"panel-body\">
        ");
      $sql = "select * from comments where pri_user_id=$user_id or project_id=$pro_dbid[$i] order by created_at desc;";
      $res = mysql_query($sql);
      $cnt=mysql_num_rows($res);
      for($j=0;$j<$cnt;$j++)
      {
        $content = mysql_result($res,$j,'CONTENTS');
        $time = mysql_result($res,$j,'created_at');
        $commenter_id = mysql_result($res,$j, 'pri_user_id');
        $head_time = substr($time, 0,10);
        $type = mysql_result($res,$j,'TYPE');
        $project_id = mysql_result($res,$j,'project_id');
        $icone = icone_text($type);

        $sql2 = "select PICTURE, NAME, id from users where id = $commenter_id;";
        $res2 = mysql_query($sql2);

        $picture_path = mysql_result($res2,0,'PICTURE');
        $user_name = mysql_result($res2,0,'NAME');
        $comment_user_id = mysql_result($res2,0,'id');

        $temp_comment="";
        if($type==0){
          $q_temp = "select TITLE from projects where id=$project_id;";
          $res_temp = mysql_query($q_temp);
          $project_name = mysql_result($res_temp, 0);
          $temp_comment=$content;
          $content="$user_name"."님이 "."$project_name"."에 댓글을 남겼습니다.";
        }
        echo("  
         <div class=\"form-group\">
         <img onclick=\"user_info($comment_user_id);\" class=\"timeline-user-img left\" src=\"/uploads/userImg/$picture_path\"/>
         <div class=\"col-md-6\">
         <h4 onclick=\"user_info($comment_user_id);\" class=\"time-line-user-name\">$user_name</h4>
         <label class=\"time-line-label\" onclick=\"getAlbumInfo($project_id);\">
         $icone
         $content
         </label>
         <div>
         $temp_comment
         </div>
         </div>

         <div class=\"right time-line-date\">
         $time
         </div>
         </div>
         ");
      }
      echo("
        </div>
        </div>
        </div>
        ");
      }
      }
      ?>
      </div>
    </div>

    <div class="side-area-panel panel panel-default right">
      <iframe src='/main/myProject/create-project_frame.php' class="create-project-frame" id="create-project-frame" name='create-project-frame' scrolling=no></iframe>
    </div>

    <div class="side-area-panel panel panel-default right" style="margin-top: 0px;">
      <!-- Default panel contents -->
      <div class="side-banner">
        <div class="myproject-mp-banner"></div>
      </div>

      <!-- List group -->
      <ul id="list-group-item" class="list-group">
        <?php
        for($i=0; $i<$count; $i++){
          echo("
            <li class=\"list-group-item\">
            <div class=\"row\">
            <div onclick=\"getAlbumInfo($pro_dbid[$i]);\" class=\"myproject-title col-md-8\">$pro_dbTITLE[$i]</div>
            <div onclick=\"user_info($pro_dbpri_user_id[$i]);\" class=\"myproject-artist col-md-4\">$pro_dbARTIST[$i]</div>
            </div>
            </li>
            ");
        }
        ?>
      </ul>
    </div>

    <div class="side-area-panel panel panel-default right" style="margin-top: 0px;">
      <!-- Default panel contents -->
      <div class="side-banner">
        <div class="myproject-pp-banner"></div>
      </div>

      <!-- List group -->
      <ul id="list-group-item" class="list-group">
        <?php
    // include("/home/mh/soma/webpage/main/favorite_connect.php");
        $q2="select sources.*, projects.ARTIST as ARTIST, projects.TITLE as TITLE, projects.pri_user_id as creator_id from sources,projects where sources.project_id=projects.id and sources.pri_user_id=$user_id;";
        $sql_result2=mysql_query($q2, $db_conn);        
        $count2=mysql_num_rows($sql_result2);
        for($i=0; $i<$count2; $i++){
          $pro_dbid[$i]=mysql_result($sql_result2, $i, 'project_id');
          $pro_dbTITLE[$i]=mysql_result($sql_result2, $i, 'TITLE');
          $pro_dbcreator_id[$i]=mysql_result($sql_result2, $i, 'creator_id');
          $pro_dbARTIST[$i]=mysql_result($sql_result2, $i, 'ARTIST');
        }
        for($i=0; $i<$count2; $i++){
          echo("
            <li class=\"list-group-item\">
            <div class=\"row\">
            <div onclick=\"getAlbumInfo($pro_dbid[$i]);\" class=\"participated-title col-md-8\">$pro_dbTITLE[$i]</div>
            <div onclick=\"user_info($pro_dbcreator_id[$i]);\" class=\"myproject-artist col-md-4\">$pro_dbARTIST[$i]</div>
            </div>
            </li>
            ");
        }
        ?>
      </ul>
    </div>