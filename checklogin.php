<?php
session_start();
include("config.php");
//$con = new Connection();
//include("lib/dboperation.php");
//include_once("lib/getval.php");
//$cmn = new Comman();
//$ipaddress = $cmn->get_client_ip();

//echo $_POST['login'];die;
if(isset($_POST['login']))
{
	
	 $admin_name = $_POST['admin_name'];	
	$admin_pwd = $_POST['admin_pwd'];
	$createdate = date('Y-m-d');
	//$admin_pwd =encrypt($admin_pwd,"trinitysolutions");
	if($admin_name != "" && $admin_pwd != "" )
	{
		//echo "hii" ;
		//echo "select * from m_user where username='$admin_name' and password='$admin_pwd'";die;
		$res = mysqli_query($connection,"select * from user where username='$admin_name' and password='$admin_pwd'");
		$count = mysqli_num_rows($res);
	
		if($count == 1)
		{
			$login_fetch = mysqli_fetch_assoc($res);
			$_SESSION['userid'] = $login_fetch['userid'];
			$_SESSION['usertype'] = $login_fetch['usertype'];
				$_SESSION['role_id'] = $login_fetch['role_id'];
			
			
			echo "<script>location='dashboard.php' </script>" ;
		}
		else
		echo "<script>location='index.php?msg=error' </script>" ;
	}
	echo "<script>location='index.php?msg=blank' </script>" ;
}

?>