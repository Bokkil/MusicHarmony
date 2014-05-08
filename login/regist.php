<?PHP
	//ALTER TABLE `테이블명` CHANGE `컬럼명` `컬럼명` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL; //업데이트 자동 생성
	include("../include/config/config.php");
	include("loginfuntion.php");

	$name = $_REQUEST['userName'];
	$email = $_REQUEST['userEmail'];
	$password = $_REQUEST['userPassword'];
	$part = $_REQUEST['userPart'];

	$cost = 10;
	$salt = ""; 
	for ($i = 0; $i < 22; $i++)
	    $salt .= substr("./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789", mt_rand(0, 63), 1);
	$salt = '$2a$'.$cost.'$'.$salt.'$';
	$password = crypt($password, $salt);

	$sql = "Insert into users (NAME,EMAIL,PASSWORD,SALT,PART,created_at) values('$name','$email','$password','$salt' ,'$part',NOW())";

	$res = mysql_query($sql); 

	if($res == 1)
	{
		echo("<script> 
		window.alert('Register Sucess!'); 
		window.location='/login/loginform.php';
		</script>");
		// loginf($email,$password);
		exit();
	}
	else
	{
		$sqlerr = mysql_error($db_conn);
		 if("NAME" == substr($sqlerr, -5,4))
		 {
			 	echo("<script> 
				window.alert('You can not use this Name'); 
				window.location='/login/loginform.php';
				</script>");
		 }
		 else if("EMAIL" == substr($sqlerr, -6,5))
		 {
		 		echo("<script> 
				window.alert('You can not use this Email Adress'); 
				window.location='/login/loginform.php';
				</script>");
		 }
		exit(); 
	}
	exit();

?>