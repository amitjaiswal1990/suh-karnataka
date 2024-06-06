<?php
include("adminsession.php");
	$districtid=trim(addslashes($_REQUEST['districtid']));
	$ulbid=trim(addslashes($_REQUEST['ulbid']));
	$ngoid=trim(addslashes($_REQUEST['ngoid']));
	$atten_date=trim(addslashes($_REQUEST['atten_date']));
	$pid=trim(addslashes($_REQUEST['pid']));
	$attendance='Present';
	
//	echo "insert into attendance_details set districtid='$districtid',ulbid='$ulbid',ngoid='$ngoid',atten_date='$atten_date',pid='$pid',attendance='$attendance',userid='$loginid'";
	mysqli_query($connection,"insert into attendance_details set districtid='$districtid',ulbid='$ulbid',ngoid='$ngoid',atten_date='$atten_date',pid='$pid',attendance='$attendance',userid='$loginid',createdate='$createdate'");
	
	?>
