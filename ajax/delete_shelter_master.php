<?php include("../adminsession.php");
  $id  = $_REQUEST['id'];
$tblname  =$_REQUEST['tblname'];
$tblpkey  =$_REQUEST['tblpkey'];
$module = $_REQUEST['module'];
$submodule = $_REQUEST['submodule'];
$pagename = $_REQUEST['pagename'];
//$imgpath = $_REQUEST['imgpath'];
$delete_date = $_REQUEST['delete_date'];
$reason = $_REQUEST['reason'];


 //$districtid = $cmn->getvalfield($connection,"m_shelter","districtid","shelter_id =$id");
//$ulbid = $cmn->getvalfield($connection,"m_shelter","ulbid","shelter_id =$id");
// $ngoid = $cmn->getvalfield($connection,"m_shelter","ngoid","shelter_id =$id");
 //$imgname = $cmn->getvalfield($connection,"m_shelter","imgname","shelter_id =$id");
 mysqli_query($connection,"insert into deleted_shelter (shelter_id,stateid,s_type,districtid,ngoid,ulbid,smaname,contatct_person,design_capacity,men,women,children,total,male_aged_people_no,male_children_no,male_others_no,male_differently_abled,female_aged_people_no,female_children_no,female_others_no,female_differently_abled,third_aged_people_no,third_children_no,third_others_no,third_differently_abled,createdate,updatedate,corporate_bank_account,bank_name,ac_no,ifsc_code,branch,opening_date,userid,entry_type)  select shelter_id,stateid,s_type,districtid,ngoid,ulbid,smaname,contatct_person,design_capacity,men,women,children,total,male_aged_people_no,male_children_no,male_others_no,male_differently_abled,female_aged_people_no,female_children_no,female_others_no,female_differently_abled,third_aged_people_no,third_children_no,third_others_no,third_differently_abled,createdate,updatedate,corporate_bank_account,bank_name,ac_no,ifsc_code,branch,opening_date,userid,entry_type from m_shelter where shelter_id=$id");
 $lastid = mysqli_insert_id($connection);
 mysqli_query($connection,"update deleted_shelter set delete_date='$delete_date',reason='$reason' where id='$lastid'");


//mysqli_query($connection,"insert into deleted_shelter set stateid=2,districtid='$districtid',ulbid='$ulbid',ngoid='$ngoid',delete_date='$delete_date',reason='$reason'");


		$res =  mysqli_query($connection,"delete from $tblname where $tblpkey = '$id'");
		mysqli_query($connection,"delete from save_register_type where shelter_id = '$id'");
		mysqli_query($connection,"delete from save_amenities where shelter_id = '$id'");
		mysqli_query($connection,"delete from save_kichen where shelter_id = '$id'");
		


?>