<?php
include("adminsession.php");
$ngoid=trim(addslashes($_REQUEST['ngoid'])); 

if($ngoid !='')
{
	
	$sqlget = mysqli_query($connection,"select * from m_ngo where ngoid = '$ngoid'");
	$rowget = mysqli_fetch_array($sqlget);
	$jsondata = json_encode($rowget);
	echo $jsondata;
}
else
echo "0";

?>

 