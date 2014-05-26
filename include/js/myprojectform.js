function track_delete(id){
  $(document).ready(function(){
    jQuery.ajax({
    type:"POST",
    url:"/main/myProject/track-delete.php?a="+id,
    success:function(){ 
      location.reload();  
    }, error: function(xhr,status,error){
      alert(error);
    }
    }); 
  }); 
}

function comment_delete(id){
   $(document).ready(function(){
    jQuery.ajax({
    type:"POST",
    url:"/main/myProject/comment-delete.php?a="+id,
    success:function(data){
      location.reload();  
    }, error: function(xhr,status,error){
      alert(error);
    }
    }); 
  }); 
}

function check_comment(formEI)
{
	if (formEI.incomment.value.length == 0)
	{
		alert("Insert some comment");
		return false;
	}
	else
	{
		return true;
	}
	
}