<?php include("../adminsession.php");
 $id  = $_REQUEST['id'];
$tblname  =$_REQUEST['tblname'];
$tblpkey  =$_REQUEST['tblpkey'];
$module = $_REQUEST['module'];
$submodule = $_REQUEST['submodule'];
$pagename = $_REQUEST['pagename'];
$imgpath = $_REQUEST['imgpath'];

 $imgname = $cmn->getvalfield($connection,"$tblname","imgname","$tblpkey='$id'");
 
 if($imgname != "")
{
	unlink("../".$imgpath."".$imgname);
	
}



//echo "delete from $tblname where $tblpkey = '$id'";
$res =  mysqli_query($connection,"delete from $tblname where $tblpkey = '$id'");
$keyvalue = mysqli_insert_id();
if($res)
{
	
	echo "<script>location='$pagename?action=3';</script>";
}


?>