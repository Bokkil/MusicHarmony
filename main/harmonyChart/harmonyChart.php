<?PHP
// header('Content-Type: text/html; charset=utf-8');
// session_cache_expire(1800);
// session_start();
// session_unset();
?>
<script>
$(function(){  
    var menu_group = $('#menu-btn-group');
    menu_group.removeClass('menu_none');
    menu_group.removeClass('menu_atb');
    menu_group.removeClass('menu_mpb');
    menu_group.removeClass('menu_tlb');
    menu_group.addClass('menu_hcb');
});
</script>
<?php
  $base_dir = "/home/mh/soma/webpage";
  include("$base_dir/main/harmonyChart/harmonyChart_connect.php");
  include("$base_dir/main/harmonyChart/harmonyChart-carousel.php");
  include("$base_dir/main/harmonyChart/harmonyChart-list.php");
?>