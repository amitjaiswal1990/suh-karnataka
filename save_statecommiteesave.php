 <?php
include("adminsession.php");
error_reporting(0);
$pagename = "commitee_details.php";
$module = "Add Inspection Details";
$submodule = "Inspection Master";
$btn_name = "Save";
$keyvalue = 0;
$tblname = "committee_details_entry";
$tblpkey = "centryid";
$imgpath = "uploaded/committee/";
$statename = $cmn->getvalfield($connection,"m_state","statename","stateid=2");
	$stateid = $cmn->getvalfield($connection,"m_state","stateid","stateid=2");
if ( isset( $_GET[ 'centryid' ] ) )
	$keyvalue = $_GET[ 'centryid' ];
else
	$keyvalue = 0;
	

if ( isset( $_GET[ 'action' ] ) )
	$action = addslashes( trim($_GET['action']) );
else
	$action = "";
if ( isset( $_POST[ 'submit' ] ) ) {
	
$districtid =  $_POST['districtid'];			
$ngoid =  $_POST['ngoid'];
$ulbid =  $_POST['ulbid'];
//ocation_of_shelter=$_POST['location_of_shelter'];
$execommmeeting_date=$_POST['execommmeeting_date'];
$executive_commitee=$_POST['executive_commitee'];
$date_of_formation_ec=$_POST['date_of_formation_ec'];
$members_participated=$_POST['members_participated'];
$pdfmeeting= $_FILES['pdfmeeting'];


		if ( $keyvalue == 0 ) { 
	
	mysqli_query($connection,"insert into  committee_details_entry set stateid='$stateid',districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',members_participated='$members_participated',executive_commitee='$executive_commitee',date_of_formation_ec='$date_of_formation_ec',execommmeeting_date='$execommmeeting_date',entry_type='$entry_type',commi_type='state',userid='$loginid',createdate='$curredate'");
	
	foreach ($_FILES['meetingphoto']['name'] as $f => $name) {
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $name);
$extension = end($temp);

$doc_name = $name;
$tm="DOC";
$tm.=microtime(true)*1000;
$ext = pathinfo($doc_name, PATHINFO_EXTENSION);
$doc_name=$tm.".".$ext;

if ((($_FILES["meetingphoto"]["type"][$f] == "image/gif")
|| ($_FILES["meetingphoto"]["type"][$f] == "image/jpeg")
|| ($_FILES["meetingphoto"]["type"][$f] == "image/jpg")
|| ($_FILES["meetingphoto"]["type"][$f] == "image/png"))
&& ($_FILES["meetingphoto"]["size"][$f] < 2000000)
&& in_array($extension, $allowedExts))
{
	if ($_FILES["meetingphoto"]["error"][$f] > 0)
	{
	echo "Return Code: " . $_FILES["meetingphoto"]["error"][$f] . "<br>";
	}
	else
	{

	if (file_exists("uploaded/committee/" . $doc_name))
	{

	}
	else
	{  
	move_uploaded_file($_FILES["meetingphoto"]["tmp_name"][$f], "uploaded/committee/".$doc_name);
	 $docall1 .=$doc_name.",";
	
}
}
}
else
{
$error =  "Invalid file";
}
}
//echo  $docall1;
$lastid = mysqli_insert_id($connection);
$docall = rtrim($docall1,",");
mysqli_query($connection,"update  committee_details_entry set meetingphoto='$docall' where centryid='$lastid'");	

	
	
	$uploaded_filename = uploadImage($imgpath,$pdfmeeting);			
			mysqli_query($connection,"update  committee_details_entry set pdfmeeting='$uploaded_filename' where centryid='$lastid'");	


	//check Duplicate
	
 
	$action=1;
		}
		else
		{
	
			mysqli_query($connection,"update  committee_details_entry set stateid='$stateid',districtid='$districtid',ngoid='$ngoid',ulbid='$ulbid',executive_commitee='$executive_commitee',date_of_formation_ec='$date_of_formation_ec',execommmeeting_date='$execommmeeting_date',userid='$loginid',commi_type='state',entry_type='$entry_type' where centryid = '$keyvalue'");

			if($_FILES['pdfmeeting']['tmp_name']!="")
				{
					//delete old file
					 $rowimg = mysqli_fetch_array(SelectDB($connection,$tblname,"centryid = '$keyvalue'"));
					 $oldimg = $rowimg["pdfmeeting"];
					if($oldimg != "")
					unlink("uploaded/committee/$oldimg");
					
					//insert new file
					$uploaded_filename = uploadImage($imgpath,$pdfmeeting);	
					//echo "update  committee_details_entry set pdfmeeting='$uploaded_filename' where centryid='$keyvalue'";die;
			mysqli_query($connection,"update  committee_details_entry set pdfmeeting='$uploaded_filename' where centryid='$keyvalue'");
			
				}
	
		$action=2;	
		}
		echo "<script>location='$pagename?action=$action'</script>";

}
if (isset($_GET[$tblpkey])){
//$btn_name = "Update";
//echo "SELECT * from $tblname where $tblpkey = $keyvalue";die;
$sqledit = "SELECT * from $tblname where $tblpkey = $keyvalue";
$rowedit = mysqli_fetch_array( mysqli_query( $connection, $sqledit ) );
$districtid =  $rowedit['districtid'];			
$ngoid =  $rowedit['ngoid'];
$ulbid =  $rowedit['ulbid'];
//ocation_of_shelter=$rowedit['location_of_shelter'];
//$no_inmates='';
//$ngoid=$rowedit['ngoid'];		

}


?>


