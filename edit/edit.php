<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Music Harmoney</title>

  <meta name="description" content="온라인 뮤직 콜라보레이션 플랫폼" />
  <meta name="keywords" content="뮤직, 밴드, 음악, 콜라보레이션"  />
         
  <link rel="shortcut icon" href="/image/icon/icon_mh.png" />
  <link rel="apple-touch-icon" href="/image/icon/icon_mh.png" />

  <!-- java script -->
  <script src="/include/js/spin.min.js"></script>
  <script type="text/javascript" src="testAPI.js"></script>
  <link rel="stylesheet" href="/include/css/header_edit.css">

  <!-- style sheet -->
<!--  <link rel="stylesheet" href="/include/css/bootstrap.min.css">
  <link rel="stylesheet" href="/include/css/bootstrap-theme.min.css"> -->

    <link rel="stylesheet/less" href="/include/audiee/less/style3.css">
    <script src="/include/audiee/js/libs/less-1.2.2.js"></script>
    <link rel="stylesheet" href="/include/css/header_edit.css">

</head>

<body>

<!--   
  <?PHP
    // $base_dir = "/home/mh/soma/webpage";
    //include("$base_dir/include/config/header.php");
  ?> 
-->

        

<div class="navbar-less">
  <div id="topBanner-extention" class="topBanner-height">
  
  <div id="topBanner" class="navbar-inner">
    <div class="middleArea">
      <div id="modeChange-area">
        <img id="modeChangeButton" class="tilt modeChangeButton" TITLE="Mode Change"></img>
      </div>
    </div>
  </div>
    <div class="container-fluid">
      <!-- <div class="pull-left editable" id="project-name"></div> -->
      <div class="btn-toolbar" id="playback-controls">
        <input type="text" id="time-display" value="-:--:--.---">
        <button class="btn" id="play" title="play"><i class="icon-play"></i></button>
        <button class="btn" id="stop" title="stop" ><i class="icon-stop"></i></button>
        <button class="btn following" id="follow" title="toggle follow">
          <i class="icon-eye-open"></i>
          <i class="icon-eye-close"></i>
        </button>
      </div>
    </div>
  </div>
</div>

<div class="menubar" id="menu-view">
  <ul class="nav nav-pills"></ul>

</div>
<div id="app-frame" class="container-fluid">
  <div class="row-fluid">
   <div class="span12" id="editor-view">
    <div class="inner">
      <div id="time-line-height"></div>
      <div id="time-line"></div>
      <div id="tracks"></div>
      <p>websocket state: <span id="socketState">null</span></p>

    </div> 
  </div> <!-- /div#editor-view -->
</div> 
</div> <!-- /div#app-frame -->

<!-- JavaScript at the bottom for fast page loading -->

<script data-main="/include/audiee/js/main" src="/include/audiee/js/libs/require/require.js"></script>
</body>
</html>
