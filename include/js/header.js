$(function(){                              
  $("img#modeChangeButton").on('click', function(event){
      event.preventDefault();
      var menu_group = $('#menu-btn-group');
      menu_group.removeClass('menu_none');
      menu_group.removeClass('menu_atb');
      menu_group.removeClass('menu_mpb');
      menu_group.removeClass('menu_tlb');
      menu_group.addClass('menu_hcb');
      $("#content").load("/main/harmonyChart/harmonyChart.php");
    });
  // $("img#modeChangeButton").on('click', function(event){
  //     event.preventDefault();

  //     var containerArea = $('#container');
  //     if(containerArea.hasClass('normal'))
  //     { 
  //       containerArea.removeClass('normal');
  //       containerArea.addClass('detail');
  //     }
  //     else
  //     {
  //       containerArea.removeClass('detail');
  //       containerArea.addClass('normal');
  //     }
  //   });

  $("img#harmonyChartButton").on('click', function(event){
      event.preventDefault();
      $("#content").load("/main/harmonyChart/harmonyChart.php");

      var menu_group = $('#menu-btn-group');
      menu_group.removeClass('menu_none');
      menu_group.removeClass('menu_atb');
      menu_group.removeClass('menu_mpb');
      menu_group.removeClass('menu_tlb');
      menu_group.addClass('menu_hcb');
  });
  $("img#artistRankingButton").on('click', function(event){
      event.preventDefault();
      $("#content").load("/main/artistRanking/artistRanking.php");

      var menu_group = $('#menu-btn-group');
      menu_group.removeClass('menu_none');
      menu_group.removeClass('menu_hcb');
      menu_group.removeClass('menu_mpb');
      menu_group.removeClass('menu_tlb');
      menu_group.addClass('menu_atb');
  });
  $("img#myProjectButton").on('click', function(event){
      event.preventDefault();
      $("#content").load("/main/myProject/myProject.php");

      var menu_group = $('#menu-btn-group');
      menu_group.removeClass('menu_none');
      menu_group.removeClass('menu_hcb');
      menu_group.removeClass('menu_atb');
      menu_group.removeClass('menu_tlb');
      menu_group.addClass('menu_mpb');
  });
  $("img#timelineButton").on('click', function(event){
      event.preventDefault();
      $("#content").load("/main/timeline/timeline.php");

      var menu_group = $('#menu-btn-group');
      menu_group.removeClass('menu_none');
      menu_group.removeClass('menu_hcb');
      menu_group.removeClass('menu_atb');
      menu_group.removeClass('menu_mpb');
      menu_group.addClass('menu_tlb');
  });

  $("a#user-nickname").on('click', function(event){
      event.preventDefault();
      var menu_group = $('#menu-btn-group');
      menu_group.removeClass('menu_hcb');
      menu_group.removeClass('menu_atb');
      menu_group.removeClass('menu_mpb');
      menu_group.removeClass('menu_tlb');
      menu_group.addClass('menu_none');
      $("#content").load("/main/user/my_info.php");
  });
  $("a#user-logout").on('click', function(event){
      event.preventDefault();
      var menu_group = $('#menu-btn-group');
      menu_group.removeClass('menu_hcb');
      menu_group.removeClass('menu_atb');
      menu_group.removeClass('menu_mpb');
      menu_group.removeClass('menu_tlb');
      menu_group.addClass('menu_none');
      location.href="/login/logout.php";
  });
  $("a#user-project-create").on('click', function(event){
      event.preventDefault();
      var menu_group = $('#menu-btn-group');
      menu_group.removeClass('menu_none');
      menu_group.removeClass('menu_hcb');
      menu_group.removeClass('menu_atb');
      menu_group.removeClass('menu_tlb');
      menu_group.addClass('menu_mpb');
      $("#content").load("/main/myProject/create-project.php");
  });
  $("a#home-button").on('click', function(event){
      event.preventDefault();
      var menu_group = $('#menu-btn-group');
      menu_group.removeClass('menu_none');
      menu_group.removeClass('menu_atb');
      menu_group.removeClass('menu_mpb');
      menu_group.removeClass('menu_tlb');
      menu_group.addClass('menu_hcb');
      $("#content").load("/main/harmonyChart/harmonyChart.php");
  });
});

function searchAction(){
  var search_key = document.getElementById("search-box").value;
  $("#content").load("/main/search/search.php?a="+search_key);
}

function searchAction1(){
  var search_key = document.getElementById("search-box").value;

  $(document).ready(function(){
    jQuery.ajax({
    type:"GET",
    url:"./search/search-query.php?a="+search_key,
    success:function(msg){
      console.log("search keyword = "+search_key); 
      var menu_group = $('#menu-btn-group');
      menu_group.removeClass('menu_hcb');
      menu_group.removeClass('menu_atb');
      menu_group.removeClass('menu_mpb');
      menu_group.removeClass('menu_tlb');
      menu_group.addClass('menu_none');
      // $("#content").load("/main/search/search-result2.php");
      $("#content").load("/main/search/search-result2.php?a="+search_key);
    }, error: function(xhr,status,error){
      alert(error);
    }
    }); 
  });
  // $("#content").load("/main/search/search-result.php");
    // tid=setTimeout(re,100); //1초후re함수실행
}

function searchAction2() {
  var search_key = document.getElementById("search-box").value;
  var str=search_key;
  if (str=="") {
    document.getElementById("content").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("content").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","./search/search-query.php?a="+str,true);
  // xmlhttp.open("GET","./search/search-result2.php?a="+str,true);
  xmlhttp.send();
  // $("#content").load("/main/search/search-result.php");
}


/////////////////////////////////////////////////////////////////////////

function getAlbumInfo(id) {
  var project_id=id;
  console.log(project_id);
  $("#content").load("/main/myProject/projectInfo.php?a="+project_id);
}

function callEditProject(id) {
  var project_id=id;
  console.log(project_id);
  // $("#content").load("/edit/edit.php?project_id="+project_id);
  
  // location.replace("/edit/edit.php?project_id="+project_id);

  var str= "<iframe src='/edit/edit.php?project_id=";
  str+=project_id;
  str+="' width='1440px' height='1000px' scrolling=yes frameBorder='0'></iframe>";
  document.getElementById("content").innerHTML = str;
} 

function like_project(id) {
    $(document).ready(function(){
    jQuery.ajax({
    type:"POST",
    url:"/main/goodCheck.php?a="+id,
    success:function(data){
      // console.log(data);
      if(data>=1){
        alert("You have already added this project."); 
      }
      else{
            $(document).ready(function(){
              jQuery.ajax({
              type:"POST",
              url:"/main/goodFunction.php?a="+id,
              success:function(){
                alert("My Favorite !!"); 
              }, error: function(xhr,status,error){
                alert(error);
              }
              }); 
            });
      }
    }, error: function(xhr,status,error){
      alert(error);
    }
    }); 
  }); 
}

function like_project1(id) {
    // createXMLHttpRequest();
  if (id=="") {
    document.getElementById("content").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("content").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","/include/config/goodCheck.php?a="+id,true);
  // xmlhttp.open("GET","./search/search-result2.php?a="+str,true);
  xmlhttp.send();
  // $("#content").load("/main/search/search-result.php");
}

function like_project2(id){
    $(document).ready(function(){
    jQuery.ajax({
    type:"GET",
    url:"/include/config/goodCheck.php?a="+id,
    success:function(){
      console.log("project_id = "+id); 
      // $("#content").load("/main/search/search-result2.php");
      // $("#content").load("/main/search/search-result2.php?a="+search_key);
    }, error: function(xhr,status,error){
      alert(error);
    }
    }); 
  });
}

function like_project3(id) {

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("content").innerHTML=xmlhttp.responseText;
    }
  }
   // createXMLHttpRequest();
    xmlhttp.onreadystatechange = handleStateChange;
 xmlhttp.open('GET','send_coord_post.php?a='+id,true);
    xmlhttp.send();
}
