<?php

include("adminsession.php");

	$districtid=trim(addslashes($_REQUEST['districtid']));

	$ulbid=trim(addslashes($_REQUEST['ulbid']));

	$ngoid=trim(addslashes($_REQUEST['ngoid']));

	$atten_date=trim(addslashes($_REQUEST['atten_date']));

	$staffid=trim(addslashes($_REQUEST['staffid']));
    $latitude=trim(addslashes($_REQUEST['latitude']));
    $longitude=trim(addslashes($_REQUEST['longitude']));

	$attendance='Present';
    $currentdate=date('Y-m-d');
    $attendpath="uploaded/staffattendance/";
    $attendancephoto=$_FILES['attendancephoto'];
    $uploadattendancephoto= uploadImage($attendpath,$attendancephoto);
  $attendancecount=$cmn->getvalfield($connection,"staff_attendance_details","count(staffid)","districtid='$districtid' and ulbid='$ulbid' and ngoid='$ngoid' and date(atten_date)='$currentdate' and staffid='$staffid'");
//	echo "insert into attendance_details set districtid='$districtid',ulbid='$ulbid',ngoid='$ngoid',atten_date='$atten_date',staffid='$staffid',attendance='$attendance',userid='$loginid'";

if($attendancecount==0){
    // if($uploadattendancephoto!=''){
	mysqli_query($connection,"insert into staff_attendance_details set districtid='$districtid',ulbid='$ulbid',ngoid='$ngoid',atten_date='$atten_date',staffid='$staffid',attendance='$attendance',userid='$loginid',createdate='$createdate',attendancephoto='$uploadattendancephoto',latitude='$latitude',longitude='$longitude'");
$src = $_FILES['attendancephoto']['tmp_name'];
$targ = "uploaded/staffattendance/".$_FILES['attendancephoto']['name'];
move_uploaded_file($src, $targ);
    // }
    // else{
    // echo 0;
    // }
}
	

	?>

