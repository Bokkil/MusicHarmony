<?PHP
// header('Content-Type: text/html; charset=utf-8');
session_cache_expire(1800);
// session_start();
// session_unset();
?>
<!-- player -->
<!-- <link type="text/css" href="/include/css/skin/blue.monday/jplayer.blue.monday.css" rel="stylesheet" /> -->
<!-- <link type="text/css" href="/include/css/skin/midnight.black/jplayer.midnight.black.css" rel="stylesheet" /> -->
<link type="text/css" href="/include/css/skin/morning.light/jplayer.morning.light.css" rel="stylesheet" />
<script type="text/javascript" src="/include/js/jquery-1.7.2.min.js"></script>
<script src="/include/js/jquery.jplayer.min.js"></script>

<script src="/include/js/add-on/jplayer.playlist.min.js"></script>
<script src="/include/js/add-on/jquery.jplayer.inspector.js"></script>
<script src="/include/js/popcorn/popcorn.jplayer.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $("#jquery_jplayer_1").jPlayer({
      ready: function () {
        $(this).jPlayer("setMedia", {
          title: "Bubble",
          m4a: "http://www.jplayer.org/audio/m4a/Miaow-07-Bubble.m4a",
          oga: "http://www.jplayer.org/audio/ogg/Miaow-07-Bubble.ogg"
        });
      },
      swfPath: "/js",
      supplied: "m4a, oga"
    });
  });
</script>

<div id="jquery_jplayer_1" class="jp-jplayer"></div>
<div id="jp_container_1" class="jp-audio">
  <div class="jp-type-single">
    <div class="jp-gui jp-interface">
      <ul class="jp-controls">
        <li><div id="sound-title-artist-area"><img id="music-icon"><div id="sound-title-artist">ddddd</div></div></li>
        <li><a href="javascript:;" class="jp-previous" tabindex="1">previous</a></li>
        <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
        <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
        <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
        <li><a href="javascript:;" class="jp-next" tabindex="1">next</a></li>
        <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
        <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
        <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
        <li><div id="good-button-area"><img id="jp-good-button"></div></li>
        <li><div id="list-button-area"><img id="jp-list-button"></div></li>
      </ul>
      <div class="jp-progress">
        <div class="jp-seek-bar">
          <div class="jp-play-bar"></div>
        </div>
      </div>
      <div class="jp-volume-bar">
        <div class="jp-volume-bar-value"></div>
      </div>
      <div class="jp-time-holder">
        <div class="jp-current-time"></div>
        <div class="jp-duration"></div>
<!--         <ul class="jp-toggles">
          <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
          <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
        </ul> -->
        <ul class="jp-toggles">
          <!-- <li><a href="javascript:;" class="jp-full-screen" tabindex="1" title="full screen">full screen</a></li>
          <li><a href="javascript:;" class="jp-restore-screen" tabindex="1" title="restore screen" style="display: none;">restore screen</a></li> -->
          <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
          <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off" style="display: none;">repeat off</a></li>
          <li><a href="javascript:;" class="jp-shuffle" tabindex="1" title="shuffle">shuffle</a></li>
          <li><a href="javascript:;" class="jp-shuffle-off" tabindex="1" title="shuffle off" style="display: none;">shuffle off</a></li>
        </ul>
      </div>
    </div>
<!--     <div class="jp-details">
      <ul>
        <li><span class="jp-title"></span></li>
      </ul>
    </div>
    <div class="jp-no-solution">
      <span>Update Required</span>
      To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
    </div> -->
  </div>
</div>
