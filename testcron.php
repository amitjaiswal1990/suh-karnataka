<?php
date_default_timezone_set('Asia/Kolkata');
$host_name="localhost";
	$db_name="suh_karnataka";
	$db_user="suh_karnataka";
	$db_pwd="J#k1F^778[HU";
	
//$currentdate=date('d-m-Y');
//$currentdate1=date('Y-m-d');
//$currentdate1='2021-06-09';
//$currentdate='09-06-2021';
//$connection = mysqli_connect("$host_name","$db_user","$db_pwd","$db_name");
	//  $shelterdetail=mysqli_query($connection,"insert into crontest set gname='giri'");
	
	
	$currentdate=date('d-m-Y');
$currentdate1=date('Y-m-d');

//$currentdate1='2021-10-24';
//$currentdate='24-10-2021';


//$to = "girisahu591@gmail.com,admin@infomaps.in";
$to = "rkishore.infomaps@gmail.com,karnataka.sulm@gmail.com,daynulm@gmail.com,admin@infomaps.in,girisahu591@gmail.com";
$subject = "SUH Occupancy Report $currentdate";
 $txt = "Please Click Link For SUH Occupancy Details  
   infomapsdemo.in/suh-karnataka/pdf_attendancereport.php?atten_date=$currentdate1
   Once you Click the Link the PDF File Gets Downloaded Which canbe Saved / Viewed.";
$headers = "From: admin@infomaps.in" . "\r\n";

mail($to,$subject,$txt,$headers);

	

?>