<head>

  <?PHP 
  	session_start();
    $base_dir = "/home/mh/soma/webpage";
    include("$base_dir/main/file_include.php");
  ?>
</head>
<body>
	<div id="project-comments" role="form" class="form-horizontal col-md-6">
	  <label>Track</label>
	  <div class="form-group project-bottom-back">
		  <form id="add-track" action="/main/myProejct/addTrack.id>" method="post" enctype="multipart/form-data" class="form-horizontal"
		      >
		    	<div>
		    		<input type="text" class="form-control" id="input-comment" placeholder="comment" name="content"></input>
		      </div>
		      <div>
		      	<input type="file" name="SOURCE_PATH" class="form-control col-lg-10" id="input-track-area"></input>
		      	<button type="submit" class="btn btn-primary btn-xs">submit</button>
		    	</div>
		  </form>
		 </div>
	</div>

	<div id="project-comments " role="form" class="col-md-6 form-horizontal">
	  <label> Comment </label>
    <div class="form-group">
      <form id="project-comment-list" class="form-horizontal" action="/main/myProject/newComment.php">
        <div class="bs-example">
          <form id="project-comment-new" class="has-success form-inline" method="post" enctype="multipart/form-data">
            <div class="col-md-10">
            	<input type="text" class="form-control" id="input-comment" placeholder="comment" name="content"></input>
            	<input type="text" name="project_id" value="<?php echo($_SESSION['project_id']); ?>" style="display:none;"></input>
            	<input type="text" name="user_id" value="<?php echo($_SESSION['user_id']); ?>" style="display:none;"></input>
          	</div>
          	<div class="col-md-2">
          		<button type="submit" class="btn btn-primary btn-xs">submit</button> 
          	</div>
          </form>
        </div>
      </form>
    </div>
    <?PHP include("$base_dir/main/myProject/projectComments.php"); ?>
	</div>
</body>