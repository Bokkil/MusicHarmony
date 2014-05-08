<?PHP
//header('Content-Type: text/html; charset=utf-8');
session_cache_expire(1800);
//현재 페이지에만 임의로 1800을 줍니다.
session_start();
?>
<script>
      var menu_group = $('#menu-btn-group');
      menu_group.removeClass('menu_hcb');
      menu_group.removeClass('menu_atb');
      menu_group.removeClass('menu_mpb');
      menu_group.removeClass('menu_tlb');
      menu_group.addClass('menu_none');
</script>
<script type="text/javascript">
  var userId = "<?PHP echo $_SESSION["user_id"]; ?>";

  var pro_dbid = new Array();
  var pro_dbGOOD_COUNT = new Array();
  var pro_dbDOWNLOAD_COUNT = new Array();
  var pro_dbPLAY_COUNT = new Array();
  var pro_dbPLAY_TIME = new Array();

  var pro_dbcreated_at = new Array();
  var pro_dbupdated_at = new Array();
  var pro_dbALBUM_IMAGE_PATH = new Array();
  var pro_dbTITLE = new Array();
  var pro_dbARTIST = new Array();

  var pro_dbPROJECT_INFO = new Array();
  var pro_dbmeta_num = new Array();
  var pro_dbpri_user_id = new Array();
  var pro_dbGENRE = new Array();

  var user_dbNAME = new Array();
  var user_dbEMAIL = new Array();
  var user_dbPART = new Array();
  var user_dbAFFILIATE_BAND = new Array();
  var user_dbPICTURE = new Array();
  var query_count=0;
  var search_key = document.getElementById("search-box").value;
</script>

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

$searchKey=$_GET['a'];

$q="select *, projects.id as 'project_id', projects.created_at as 'project_created_at', projects.updated_at as 'project_updated_at' from projects, users where projects.pri_user_id=users.id AND (TITLE LIKE '%$searchKey%' OR ARTIST LIKE '%$searchKey%');";  
$sql_result=mysql_query($q, $db_conn);        
$count=mysql_num_rows($sql_result);

for($i=0; $i<$count; $i++)
{
  $pro_dbid[$i]=mysql_result($sql_result, $i, 'project_id');
  $pro_dbGOOD_COUNT[$i]=mysql_result($sql_result, $i, 'GOOD_COUNT');
  $pro_dbDOWNLOAD_COUNT[$i]=mysql_result($sql_result, $i, 'DOWNLOAD_COUNT');
  $pro_dbPLAY_COUNT[$i]=mysql_result($sql_result, $i, 'PLAY_COUNT');
  $pro_dbPLAY_TIME[$i]=mysql_result($sql_result, $i, 'PLAY_TIME');

  $pro_dbcreated_at[$i]=mysql_result($sql_result, $i, 'project_created_at');
  $pro_dbupdated_at[$i]=mysql_result($sql_result, $i, 'project_updated_at');
  $pro_dbALBUM_IMAGE_PATH[$i]=mysql_result($sql_result, $i, 'ALBUM_IMAGE_PATH');
  $pro_dbTITLE[$i]=mysql_result($sql_result, $i, 'TITLE');
  $pro_dbARTIST[$i]=mysql_result($sql_result, $i, 'ARTIST');

  $pro_dbPROJECT_INFO[$i]=mysql_result($sql_result, $i, 'PROJECT_INFO');
  $pro_dbmeta_num[$i]=mysql_result($sql_result, $i, 'meta_id');
  $pro_dbpri_user_id[$i]=mysql_result($sql_result, $i, 'pri_user_id');
  $pro_dbGENRE[$i]=mysql_result($sql_result, $i, 'GENRE');

  $user_dbNAME[$i]=mysql_result($sql_result, $i, 'NAME');
  $user_dbEMAIL[$i]=mysql_result($sql_result, $i, 'EMAIL');
  $user_dbPART[$i]=mysql_result($sql_result, $i, 'PART');
  $user_dbAFFILIATE_BAND[$i]=mysql_result($sql_result, $i, 'AFFILIATE_BAND');
  $user_dbPICTURE[$i]=mysql_result($sql_result, $i, 'PICTURE');
}

echo("<script>var num=0;</script>");
for($i = 0 ; $i < $count; $i++){
  echo ("<script>
      pro_dbid[num]='$pro_dbid[$i]';
      pro_dbGOOD_COUNT[num]='$pro_dbGOOD_COUNT[$i]';
      pro_dbDOWNLOAD_COUNT[num]='$pro_dbDOWNLOAD_COUNT[$i]';
      pro_dbPLAY_COUNT[num]='$pro_dbPLAY_COUNT[$i]';
      pro_dbPLAY_TIME[num]='$pro_dbPLAY_TIME[$i]';

      pro_dbcreated_at[num]='$pro_dbcreated_at[$i]';
      pro_dbupdated_at[num]='$pro_dbupdated_at[$i]';
      pro_dbALBUM_IMAGE_PATH[num]='$pro_dbALBUM_IMAGE_PATH[$i]';
      pro_dbTITLE[num]='$pro_dbTITLE[$i]';
      pro_dbARTIST[num]='$pro_dbARTIST[$i]';

      pro_dbPROJECT_INFO[num]='$pro_dbPROJECT_INFO[$i]';
      pro_dbmeta_num[num]='$pro_dbmeta_num[$i]';
      pro_dbpri_user_id[num]='$pro_dbpri_user_id[$i]';
      pro_dbGENRE[num]='$pro_dbGENRE[$i]';

      user_dbNAME[num]='$user_dbNAME[$i]';
      user_dbEMAIL[num]='$user_dbEMAIL[$i]';
      user_dbPART[num]='$user_dbPART[$i]';
      user_dbAFFILIATE_BAND[num]='$user_dbAFFILIATE_BAND[$i]';
      user_dbPICTURE[num]='$user_dbPICTURE[$i]';
      </script>");
  echo("<script>num++;</script>");
}
?>
<link rel="stylesheet" href="/include/css/style.css" />
<div id="tablewrapper">
    <div id="tableheader">
          <div class="search">
                <select id="columns" onchange="sorter.search('query')"></select>
                <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
        <div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
            <div><a href="javascript:sorter.reset()">reset</a></div>
          </span>
        </div>
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
                <tr>
                    <th class="nosort" style="visibility: hidden;"><h3></h3></th>
                    <th><h3>No</h3></th>
                    <th><h3>Title</h3></th>
                    <th><h3>Info</h3></th>
                    <th><h3>Created</h3></th>
                    <th><h3>Updated</h3></th>
                    <th><h3>Play</h3></th>
                    <th><h3>Good</h3></th>
                    <th><h3>DownLoad</h3></th>
                    <th><h3>Artist</h3></th>
                    <th><h3>Email</h3></th>
                    <th><h3>Band</h3></th>
                </tr>
            </thead>
            <tbody>
            <?php
            for($i=0; $i<$count; $i++){
              $j=$i+1;
            echo("
                <tr>
                    <td style=\"visibility: hidden;\"></td>
                    <td>$j</td>
                    <td>$pro_dbTITLE[$i]</td>
                    <td>$pro_dbPROJECT_INFO[$i]</td>
                    <td>$pro_dbcreated_at[$i]</td>
                    <td>$pro_dbupdated_at[$i]</td>
                    <td>$pro_dbPLAY_COUNT[$i]</td>
                    <td>$pro_dbGOOD_COUNT[$i]</td>
                    <td>$pro_dbDOWNLOAD_COUNT[$i]</td>
                    <td>$pro_dbARTIST[$i]</td>
                    <td><a href=\"mailto:#\">$user_dbEMAIL[$i]</a></td>
                    <td>$user_dbAFFILIATE_BAND[$i]</td>
                </tr>
            ");
            }
            ?>
            </tbody>
        </table>
        <div id="tablefooter">
          <div id="tablenav">
              <div>
                    <img src="/images/main/search/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                    <img src="/images/main/search/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                    <img src="/images/main/search/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                    <img src="/images/main/search/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                </div>
                <div>
                  <select id="pagedropdown"></select>
        </div>
                <div>
                  <a href="javascript:sorter.showall()">view all</a>
                </div>
            </div>
      <div id="tablelocation">
              <div>
                    <select onchange="sorter.size(this.value)">
                    <option value="5">5</option>
                        <option value="10" selected="selected">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>Entries Per Page</span>
                </div>
                <div class="page">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
            </div>
        </div>
    </div>
  <script type="text/javascript" src="/include/js/script.js"></script>
  <script type="text/javascript">
  var sorter = new TINY.table.sorter('sorter','table',{
    headclass:'head',
    ascclass:'asc',
    descclass:'desc',
    evenclass:'evenrow',
    oddclass:'oddrow',
    evenselclass:'evenselected',
    oddselclass:'oddselected',
    paginate:true,
    size:10,
    colddid:'columns',
    currentid:'currentpage',
    totalid:'totalpages',
    startingrecid:'startrecord',
    endingrecid:'endrecord',
    totalrecid:'totalrecords',
    hoverid:'selectedrow',
    pageddid:'pagedropdown',
    navid:'tablenav',
    sortcolumn:1,
    sortdir:1,
    sum:[8],
    avg:[6,7,8,9],
    columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
    init:true
  });
  </script>