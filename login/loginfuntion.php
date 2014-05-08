<?php
  include("../include/config/config.php");

  function loginf($email,$password)
  {
    include("../include/config/config.php");

    $sql = "select * from users where EMAIL='$email'";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    if($row)
    {
      if($row['PASSWORD'] == crypt($password, $row['SALT']))
      {
        session_start();
        $_SESSION['user_id'] = $row['id'];
        header("Location: /main/layout.php");
      }
      else
      {
        echo("<script>
          window.alert('Login Fail'); 
          window.location='/login/loginform.php';
              </script>"
            );
      }

    }
    else
    {
      echo("<script>
        window.alert('Login Fail'); 
        window.location='/login/loginform.php';
            </script>"
          );

    }
    
  }
  
?>