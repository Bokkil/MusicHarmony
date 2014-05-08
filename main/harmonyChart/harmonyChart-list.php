<div id="project-list-area-harmonychart" class="row">
  <!-- <legend>Project List</legend> -->
  <div id="project-list-harmonychart" class="col-md-3 chart-list-margin">
    <?PHP
    for($i=0; $i<7; $i++){
      echo("
      <div class=\"projects\">
        <h3>$pro_dbTITLE[$i]</h3>
        <a>
          <img onclick=\"getAlbumInfo($pro_dbid[$i]);\" class=\"morph img-radius projcet-img pull-left col-md-6\" src=\"/uploads/albumImg/$pro_dbALBUM_IMAGE_PATH[$i]\"/>
        </a>
        <div class=\"projectinfo-postion col-md-6\">
          <div>
            <label>Genre : </label> $pro_dbGENRE[$i]
          </div>
          <div>
            <label>Play Count : </label> $pro_dbPLAY_COUNT[$i]
          </div>
          <div>
            <label>Good Count : </label> $pro_dbGOOD_COUNT[$i]
          </div>
          <div>
            <label>Download Count : </label> $pro_dbDOWNLOAD_COUNT[$i]
          </div>
        </div>
        <br>
        <h5 style=\"clear: both;padding-top: 10px;\"> Info : $pro_dbPROJECT_INFO[$i]</h5>
      </div>
      <div class=\"center\">
        <img class=\"under-bar-line under-bar-line-shot\"></img>
      </div>
      ");
    }
    ?>
  </div>
  <div id="project-list-harmonychart" class="col-md-3 chart-list-margin">
    <?PHP
    for($i=7; $i<14; $i++){
      echo("
      <div class=\"projects\">
        <h3>$pro_dbTITLE[$i]</h3>
        <a>
          <img onclick=\"getAlbumInfo($pro_dbid[$i]);\" class=\"morph img-radius projcet-img col-md-6\" src=\"/uploads/albumImg/$pro_dbALBUM_IMAGE_PATH[$i]\"/>
        </a>
        <div class=\"projectinfo-postion col-md-6\">
          <div>
            <label>Genre : </label> $pro_dbGENRE[$i]
          </div>
          <div>
            <label>Play Count : </label> $pro_dbPLAY_COUNT[$i]
          </div>
          <div>
            <label>Good Count : </label> $pro_dbGOOD_COUNT[$i]
          </div>
          <div>
            <label>Download Count : </label> $pro_dbDOWNLOAD_COUNT[$i]
          </div>
        </div>
        <h5 style=\"clear: both;padding-top: 10px;\">Info : $pro_dbPROJECT_INFO[$i]</h5>
      </div>
      <div class=\"center\">
        <img class=\"under-bar-line under-bar-line-shot\"></img>
      </div>
      ");
    }
    ?>
  </div>
  <div id="project-list-harmonychart" class="col-md-3 chart-list-margin">
    <?PHP
    for($i=14; $i<21; $i++){
      echo("
      <div class=\"projects\">
        <h3>$pro_dbTITLE[$i]</h3>
        <a>
          <img onclick=\"getAlbumInfo($pro_dbid[$i]);\" class=\"morph img-radius projcet-img col-md-6\" src=\"/uploads/albumImg/$pro_dbALBUM_IMAGE_PATH[$i]\"/>
        </a>
        <div class=\"projectinfo-postion col-md-6\">
          <div>
            <label>Genre : </label> $pro_dbGENRE[$i]
          </div>
          <div>
            <label>Play Count : </label> $pro_dbPLAY_COUNT[$i]
          </div>
          <div>
            <label>Good Count : </label> $pro_dbGOOD_COUNT[$i]
          </div>
          <div>
            <label>Download Count : </label> $pro_dbDOWNLOAD_COUNT[$i]
          </div>
        </div>
        <h5 style=\"clear: both;padding-top: 10px;\">Info : $pro_dbPROJECT_INFO[$i]</h5>
      </div>
      <div class=\"center\">
        <img class=\"under-bar-line under-bar-line-shot\"></img>
      </div>
      ");
    }
    ?>
  </div>
  <div id="project-list-harmonychart" class="col-md-3 chart-list-margin">
    <?PHP
    for($i=21; $i<28; $i++){
      echo("
      <div class=\"projects\">
        <h3>$pro_dbTITLE[$i]</h3>
        <a>
          <img onclick=\"getAlbumInfo($pro_dbid[$i]);\" class=\"morph img-radius projcet-img col-md-6\" src=\"/uploads/albumImg/$pro_dbALBUM_IMAGE_PATH[$i]\"/>
        </a>
        <div class=\"projectinfo-postion col-md-6\">
          <div>
            <label>Genre : </label> $pro_dbGENRE[$i]
          </div>
          <div>
            <label>Play Count : </label> $pro_dbPLAY_COUNT[$i]
          </div>
          <div>
            <label>Good Count : </label> $pro_dbGOOD_COUNT[$i]
          </div>
          <div>
            <label>Download Count : </label> $pro_dbDOWNLOAD_COUNT[$i]
          </div>
        </div>
        <h5 style=\"clear: both;padding-top: 10px;\">Info : $pro_dbPROJECT_INFO[$i]</h5>
      </div>
      <div class=\"center\">
        <img class=\"under-bar-line under-bar-line-shot\"></img>
      </div>
      ");
    }
    ?>
  </div>
</div>