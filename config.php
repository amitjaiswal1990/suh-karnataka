<?php //define('TIMEZONE', 'Asia/Calcutta'); // INDIA


$host_name="localhost";
	$db_name="suh_karnataka";
	$db_user="root";
	$db_pwd="";
	


$connection = mysqli_connect("$host_name","$db_user","$db_pwd","$db_name");


if (!$connection) {
    die('Could not connect: ' . mysqli_connect_error());
}
//echo ("dATABASE cONNECTED");
//$createdate = date('Y-m-d H:m:s');

//45.40.164.22
?>

