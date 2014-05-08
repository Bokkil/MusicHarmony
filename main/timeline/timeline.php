<?PHP
include("../../include/config/config.php");
header('Content-Type: text/html; charset=utf-8');
session_cache_expire(1800);
session_start();
// session_unset();
$user_id=$_SESSION["user_id"];

?>

<div class="content-left">
  <div class="bar-area">
    <img id="timeline-bar-img"></img>
  </div>

  <div class="bs-example normal col-md-11" id="project-list-area-myproject">
    <legend>Comment & TimeLine</legend>
    <div id="project-comments" role="form">
      <form class="form-horizontal">
        <?php
          $sql = "select * from comments where pri_user_id='$user_id' order by created_at desc";
          $res = mysql_query($sql);
          $cnt=mysql_num_rows($res);
          $flag = "0000-00-00";

          for($i=0;$i<$cnt;$i++)
          {
            $content = mysql_result($res,$i,'CONTENTS');
            $time = mysql_result($res,$i,'created_at');
            $head_time = substr($time, 0,10);
            
            if($flag != $head_time)
            {
              $date_form="<div>
                    <hr style=\"margin-top: 5px; margin-bottom: 5px;\" />
                      <div style=\"font-size: 16px\">$head_time </div>
                    <hr style=\"margin-top: 5px; margin-bottom: 15px;\" />
                  </div>";
              $flag = $head_time;
            }
            else
            {
              $date_form="";
            }

            $sql2 = "select PICTURE from users where id = $user_id;";
            $res2 = mysql_query($sql2);

            $picture_path = mysql_result($res2,0);
            if(!$picture_path)
              $picture_path = "def";
            
            
            echo("
              
               <div class=\"form-group\">
                  $date_form
                  <img \" class=\"projcet-img left\" src=\"/uploads/userImg/$picture_path\"/>
                  <div>
                    $content
                  </div>

                  <div class=\"right\">
                    $time
                  </div>
                </div>
                <hr>
              ");
          }
          // $sql = "select * from users_projects where user_id='$user_id'";
          // $res = mysql_query($sql);
          // $cnt=mysql_num_rows($sql_result);
          // for($i=0;$i<$cnt;$i=$i++)
          // {
          //   $project_id=mysql_result($res,$i,'project_id');
          //   $sql2 = "select * from projects where pri_user_id = '$project_id'";
          // }
        ?>
      </form>
      <hr>
    </div>
  </div>
</div>
<div id="create_project_frame_div" class="create_project_frame_div">
  <iframe src='/main/myProject/create-project_frame.php' id="create-project-frame" name='create-project-frame' width="360px" height="450px" scrolling=no frameBorder="0" style="position: fixed; top: 342px;"></iframe>
</div>
